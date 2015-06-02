<responseCondition>
    <responseIf>
        <not>
            <match>
                <variable identifier="{{response}}" />
                <correct identifier="{{response}}" />
            </match>
        </not>
        <setOutcomeValue identifier="{{feedback.outcome}}">
            <baseValue baseType="identifier">{{feedback.then}}</baseValue>
        </setOutcomeValue>
    </responseIf>
    {{~#if feedback.else}}
    <responseElse>
        <setOutcomeValue identifier="{{feedback.outcome}}">
            <baseValue baseType="identifier">{{feedback.else}}</baseValue>
        </setOutcomeValue>
    </responseElse>
    {{~/if}}
</responseCondition>