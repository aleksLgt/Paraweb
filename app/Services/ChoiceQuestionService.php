<?php

namespace App\Services;

use App\Models\ChoiceQuestion;
use App\Models\ChoiceQuestionAnswer;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Throwable;

class ChoiceQuestionService
{
    /**
     * @throws Throwable
     */
    public function create(mixed $requestData): void
    {
        DB::transaction(function () use ($requestData) {
            $choiceQuestion = ChoiceQuestion::create($requestData);
            foreach ($requestData['answers'] as $answer) {
                $choiceQuestion->answers()->create(['text'  =>  $answer]);
            }
        });
    }

    /**
     * @throws Throwable
     */
    public function update(mixed $requestData, $questionId): void
    {
        DB::transaction(function () use ($requestData, $questionId) {
            ChoiceQuestion::find($questionId)->update($requestData);
            ChoiceQuestionAnswer::whereChoiceQuestionId($questionId)->delete();
            foreach ($requestData['answers'] as $answer) {
                ChoiceQuestion::find($questionId)->answers()->create(['text'  =>  $answer]);
            }
        });
    }

    public function delete($questionId): int
    {
        return ChoiceQuestion::destroy($questionId);
    }

    public function hide($questionId): bool|int
    {
        return ChoiceQuestion::whereId($questionId)->update(['is_visible' =>  false]);
    }

    public function visible($questionId): bool|int
    {
        return ChoiceQuestion::whereId($questionId)->update(['is_visible' =>  true]);
    }

    public function getUnselectedAnswersOfQuestion($questionId): array
    {
        return ChoiceQuestionAnswer::whereChoiceQuestionId($questionId)
            ->whereDoesntHave('user_answers')
            ->get()
            ->toArray();
    }

    /**
     * @throws Exception
     */
    public function deleteQuestionAnswer($questionId, $answerId)
    {
        if (ChoiceQuestionAnswer::whereId($answerId)
            ->whereChoiceQuestionId($questionId)
            ->doesntExist()) {
            return response()->json('This answer does not belong to the specified question.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (ChoiceQuestionAnswer::whereChoiceQuestionId($questionId)
            ->whereId($answerId)
            ->whereHas('user_answers')
            ->exists()) {
            return response()->json('Сannot delete an answer to a question that has answers from users.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ChoiceQuestionAnswer::whereChoiceQuestionId($questionId)
            ->whereId($answerId)
            ->delete();
    }

    public function get($questionId): array
    {
        return ChoiceQuestion::whereId($questionId)->with('answers')->get()->toArray();
    }
}
