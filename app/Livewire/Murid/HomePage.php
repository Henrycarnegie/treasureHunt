<?php

namespace App\Livewire\Murid;

use App\Models\AnswerLevel1;
use App\Models\AnswerLevel2;
use App\Models\AnswerLevel3;
use App\Models\FirstAcccessLevel1;
use App\Models\FirstAcccessLevel2;
use App\Models\FirstAcccessLevel3;
use App\Models\FirstAccessLevel4;
use App\Models\FirstAccessLevel5;
use App\Models\Murid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class HomePage extends Component
{
    use LivewireAlert;

    public function cekAksesLevel1(){
        $auth = Auth::user();
        $data = FirstAcccessLevel1::where('role_name', $auth->getRoleNames()->first())->first();
        $murid = Murid::where('users_id', $auth->id)->first();
        $answer = AnswerLevel1::where('murid_id', $murid->id)->get();

        if ($data !== null) {
            $endTimeString = $data->end_time;
            $createdAt = $data->created_at;

            $endTime = Carbon::createFromTimestampMs($endTimeString);
            $createdAtCarbon = Carbon::parse($createdAt);

            $remainingTime = $endTime->diffInMilliseconds($createdAtCarbon);

            if ($remainingTime <= 0) {
                if(count($answer) > 0){
                    $this->alert('info', 'Level 1 Selesai', [
                        'text' => 'Anda Telah Mengerjakan level 1 dengan selesai.',
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => false,
                        'timerProgressBar' => true,
                    ]);
                }else{
                    return redirect(route('murid.level1'));
                }
            }
        } else {
            return redirect(route('murid.level1'));
        }
    }

    public function cekAksesLevel2(){
        $auth = Auth::user();
        $data1 = FirstAcccessLevel1::where('role_name', $auth->getRoleNames()->first())->first();
        $data = FirstAcccessLevel2::where('role_name', $auth->getRoleNames()->first())->first();
        $murid = Murid::where('users_id', $auth->id)->first();
        $answer = AnswerLevel2::where('murid_id', $murid->id)->get();

        if(isset($data1) && $data1->status == 1){
            if ($data !== null) {
                $endTimeString = $data->end_time;
                $createdAt = $data->created_at;

                $endTime = Carbon::createFromTimestampMs($endTimeString);
                $createdAtCarbon = Carbon::parse($createdAt);

                $remainingTime = $endTime->diffInMilliseconds($createdAtCarbon);

                if ($remainingTime <= 0) {
                    if(count($answer) > 0){
                        $this->alert('info', 'Level 2 Selesai', [
                            'text' => 'Anda Telah Mengerjakan level 2 dengan selesai.',
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => false,
                            'timerProgressBar' => true,
                        ]);
                    }else{
                        return redirect(route('murid.level2'));
                    }
                }
            } else {
                return redirect(route('murid.level2'));
            }
        }else{
            $this->alert('warning', 'Level 2 Tidak dapat di akses', [
                'text' => 'Selesaikan level 1 terlebih dahulu',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function cekAksesLevel3(){
        $auth = Auth::user();
        $data = FirstAcccessLevel3::where('role_name', $auth->getRoleNames()->first())->first();
        $data1 = FirstAcccessLevel2::where('role_name', $auth->getRoleNames()->first())->first();
        $murid = Murid::where('users_id', $auth->id)->first();
        $answer = AnswerLevel3::where('murid_id', $murid->id)->get();

        if(isset($data1) && $data1->status == 1){
            if ($data !== null) {
                $endTimeString = $data->end_time;
                $createdAt = $data->created_at;

                $endTime = Carbon::createFromTimestampMs($endTimeString);
                $createdAtCarbon = Carbon::parse($createdAt);

                $remainingTime = $endTime->diffInMilliseconds($createdAtCarbon);

                if ($remainingTime <= 0) {
                    if(count($answer) > 0){
                        $this->alert('info', 'Level 3 Selesai', [
                            'text' => 'Anda Telah Mengerjakan level 3 dengan selesai.',
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => false,
                            'timerProgressBar' => true,
                        ]);
                    }else{
                        return redirect(route('murid.level3'));
                    }
                }
            } else {
                return redirect(route('murid.level3'));
            }
        }else{
            $this->alert('warning', 'Level 3 Tidak dapat di akses', [
                'text' => 'Selesaikan level 2 terlebih dahulu',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }
    }

    public function cekAksesLevel4(){
        $auth = Auth::user();
        $data = FirstAccessLevel4::where('role_name', $auth->getRoleNames()->first())->first();
        $data1 = FirstAcccessLevel3::where('role_name', $auth->getRoleNames()->first())->first();

        if(isset($data1) && $data1->status == 1){
            if ($data !== null) {
                if ($data->status == true) {
                    $this->alert('info', 'Level 4 Selesai', [
                        'text' => 'Anda Telah Mengerjakan level 4 dengan selesai.',
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => false,
                        'timerProgressBar' => true,
                    ]);
                }else{
                    return redirect(route('murid.level4'));
                }
            } else {
                return redirect(route('murid.level4'));
            }
        }else{
            $this->alert('warning', 'Level 4 Tidak dapat di akses', [
                'text' => 'Selesaikan level 3 terlebih dahulu',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }

    }

    public function cekAksesLevel5(){
        $auth = Auth::user();
        $data = FirstAccessLevel5::where('role_name', $auth->getRoleNames()->first())->first();
        $data1 = FirstAccessLevel4::where('role_name', $auth->getRoleNames()->first())->first();

        if(isset($data1) && $data1->status == 1){
            if ($data !== null) {
                if ($data->status == true) {
                    $this->alert('info', 'Level 5 Selesai', [
                        'text' => 'Anda Telah Mengerjakan level 5 dengan selesai.',
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => false,
                        'timerProgressBar' => true,
                    ]);
                }else{
                    return redirect(route('murid.level5'));
                }
            } else {
                return redirect(route('murid.level5'));
            }
        }else{
            $this->alert('warning', 'Level 5 Tidak dapat di akses', [
                'text' => 'Selesaikan level 4 terlebih dahulu',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }

    }
    public function render()
    {
        return view('livewire.murid.home-page')->extends('layouts.app');
    }
}
