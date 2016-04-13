<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{

    public function tasks() {
        return $this->belongsToMany('App\Task')->withPivot('points', 'start_date', 'end_date');
    }

    public function hints() {
        return $this->belongsToMany('App\Hint');
    }

    public function participations() {
    	return $this->hasMany('App\Participation');
    }

    public function submissions()
    {
        return $this->hasManyThrough('App\Submission', 'App\Participation');
    }

    public function getParticipants() {
        return User::find($this->participations->pluck('user_id')->all());
    }

    public function getCorrectSubmissions() {
        return $this->submissions->where('status', 1)->all();
    }

    /**
     * return array of objects with three attributes: position, user, points
     */
    public function getScoreBoardData() {
        $participations = $this->participations;
        foreach ($participations as $p) {
            $p->final_points = $p->user->score($this);
            $p->final_latest_submit = $p->user->getLatestSubmitTime($this);
        }
        // $participations = $participations
        //                     ->sortBy('final_latest_submit')
        //                     ->sortByDesc('final_points');


        $participations = $participations->sort(function($a, $b) {
            if($a->final_points === $b->final_points) {
                if($a->final_latest_submit === $b->final_latest_submit) {
                    return 0;
                }
                    return $a->final_latest_submit < $b->final_latest_submit ? -1 : 1;
                } 
                return $a->final_points < $b->final_points ? 1 : -1;
        });

        $i = 1;
        foreach ($participations as $p) {
            $p->final_position = $i++;
        }

        return $participations;
    }

    public function getFinalScoreBoardData() {
        return $this->participations->sortByDesc('final_position');
    }

}
