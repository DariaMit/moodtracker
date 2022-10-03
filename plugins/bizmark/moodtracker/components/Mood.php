<?php namespace Bizmark\Moodtracker\Components;

use Bizmark\Moodtracker\Models\MoodItem;
use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use RainLab\User\Facades\Auth;

/**
 * Mood Component
 */
class Mood extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Mood Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $today = Carbon::now()->toDateString();
        $this->page['today_mood'] = MoodItem::getOneDayAvgMood($today);
        $this->page['week_mood'] = MoodItem::getWeekDaysAvgMood();
    }

    public function onEvaluate()
    {
        //TODO: надо прописать как вытаскивается настроение

        $mood = null;

        $moodItem = MoodItem::create([
            'person' => Auth::user()->id,
            'mood' => $mood
        ]);
    }
}
