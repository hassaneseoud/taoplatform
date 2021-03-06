<?php
/**  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA;
 *               
 * 
 */
 
/**
 * This helper class aims at formating the item content folder description
 *
 */
class taoItems_helpers_ResourceManager
{
    
    public static function buildDirectory(core_kernel_classes_Resource $item, $lang, $relPath = '/', $depth = 1, $filters = array()) {
        
        $baseDir = taoItems_models_classes_ItemsService::singleton()->getItemFolder($item, $lang);
        $path = $baseDir.ltrim($relPath, '/');
        
        $data = array(
            'path' => $relPath
        );
        if ($depth > 0 ) {
            $children = array();
            if (is_dir($path)) {
                foreach (new DirectoryIterator($path) as $fileinfo) {
                    if (!$fileinfo->isDot()) {
                        $subPath = rtrim($relPath, '/').'/'.$fileinfo->getFilename();
                        if ($fileinfo->isDir()) {
                            $children[] = self::buildDirectory($item, $lang, $subPath, $depth-1, $filters);
                        } else {
                            $file = self::buildFile($item, $lang, $subPath, $filters);
                            if(!is_null($file)){
                                $children[] = $file;
                            }
                        }
                    }
                }
            } else {
                common_Logger::w('"'.$path.'" is not a directory');
            }
            $data['children'] = $children;
        } else {
            $data['url'] = _url('files', 'ItemContent', 'taoItems', array('uri' => $item->getUri(),'lang' => $lang, 'path' => $relPath));
        }
        return $data;
    }
    
    public static function buildFile(core_kernel_classes_Resource $item, $lang, $relPath, $filters = array()) {
        $file = null;
        $baseDir = taoItems_models_classes_ItemsService::singleton()->getItemFolder($item, $lang);
        $path = $baseDir.ltrim($relPath, '/');
        $mime = tao_helpers_File::getMimeType($path);

        if(count($filters) == 0 || in_array($mime, $filters)){
            $file = array(
                'name' => basename($path),
                'mime' => $mime,
                'size' => filesize($path),
                'url' => _url('download', 'ItemContent', 'taoItems', array('uri' => $item->getUri(),'lang' => $lang, 'path' => $relPath))
            );
        }
        return $file;
    }
    
}
