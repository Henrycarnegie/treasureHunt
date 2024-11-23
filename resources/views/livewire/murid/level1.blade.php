@section('title', 'Level 1')

<form wire:submit.prevent="simpanJawaban"
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-700 py-12 px-6 lg:px-20 xl:px-60 relative"
x-data="{
          currentQuestion: 1,
          totalQuestions: {{ $data->where('role_name', auth()->user()->getRoleNames()->first())->count() }},
          selectedAnswer: @entangle('selectedAnswer'),
          previousQuestion() {
              if (this.currentQuestion > 1) {
                  this.currentQuestion--;
              }
          },
          nextQuestion() {
              if (this.currentQuestion < this.totalQuestions) {
                  this.currentQuestion++;
              }
          }
      }">
    <x-murid.layout-level infoLevel="1" :data="$data" :endTime="$endTime" :startTime="$startTime" :levelTimeLeft="$countdown" :display="$display" :selectedAnswer="$selectedAnswer"></x-murid.layout-level>
</form>
