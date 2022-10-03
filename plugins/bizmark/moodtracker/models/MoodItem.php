<?php namespace Bizmark\Moodtracker\Models;

use Carbon\Carbon;
use Model;
use RainLab\User\Models\User;

/**
 * MoodItem Model
 */
class MoodItem extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'bizmark_moodtracker_mood_items';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = ['*'];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = [];

    /**
     * @var array rules for validation
     */
    public $rules = [
        //TODO
        'person' => 'required',
        'mood' => 'required|numeric',
        'created_at' => 'required'
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user' => User::class,
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getPersonOptions()
    {
        return User::all()->pluck('name', 'id');
    }

    static public function calculateAvg(array $allMoods)
    {
        return array_sum($allMoods) / count($allMoods);
    }

    public function scopeGetOneDayAvgMood($query, $day)
    {
        $allMoods = $query->where('created_at', 'LIKE', '%'.$day.'%')->pluck('mood')->toArray();
        if ($allMoods){
            return self::calculateAvg($allMoods);
        }
        return 0;
    }

    public function scopeGetWeekDaysAvgMood($query)
    {
        $weekAgo = Carbon::now()->startOfWeek();
        $weekday = Carbon::now()->dayOfWeek;
        $avgEachDay = [];
        for ($day=1; $day<=$weekday;$day++){
            $date = $weekAgo->toDateString();
            $allMoods = self::getOneDayAvgMood($date);
            $avgEachDay[] = $allMoods;
            $weekAgo = $weekAgo->addDay();
        }
        return $avgEachDay;
    }
}
