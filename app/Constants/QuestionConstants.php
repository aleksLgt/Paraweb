<?php

namespace App\Constants;

interface QuestionConstants
{
    const SINGLE_ANSWER_TYPE     =   0;
    const SEVERAL_ANSWER_TYPE    =   1;

    const QUESTION_TYPES    =   [
        self::SINGLE_ANSWER_TYPE,
        self::SEVERAL_ANSWER_TYPE
    ];
}
