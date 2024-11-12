@section('title', 'Level 1')

<form wire:submit.prevent="simpanJawaban"
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-700 py-12 px-6 lg:px-20 xl:px-60 relative"
x-data="{
          currentQuestion: 1,
          totalQuestions: {{ $data->where('role_name', auth()->user()->getRoleNames()->first())->count() }},
          selectedAnswer: @entangle('selectedAnswer'), // Mengikat dengan Livewire
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
    <x-murid.layout-level x-data="{isModalWarning: true}" infoLevel="1" :data="$data" :levelTimeLeft="$countdown" :display="$display" :selectedAnswer="$selectedAnswer"></x-murid.layout-level>
</form>


<script>
    function countdown(levelTimeLeft) {
    return {
        display: '00:00',
        endTime: parseInt(localStorage.getItem('countdownEndTime')) || Date.now() + Math.max(0, parseInt(levelTimeLeft) * 60 * 1000),
        intervalId: null,
        isFinished: false,

        init() {
            // Set end time to local storage jika belum diset
            if (!localStorage.getItem('countdownEndTime')) {
                localStorage.setItem('countdownEndTime', this.endTime);
            }
            this.startCountdown();
        },

        startCountdown() {
            this.updateDisplay();
            this.intervalId = setInterval(() => {
                const now = Date.now();
                const remaining = Math.max(0, this.endTime - now);

                if (remaining > 0) {
                    this.updateDisplay(remaining);
                } else {
                    this.finishCountdown();
                }
            }, 100);
        },

        finishCountdown() {
            if (!this.isFinished) {
                this.isFinished = true;
                clearInterval(this.intervalId);
                this.display = '00:00';
                localStorage.removeItem('countdownEndTime'); // Hapus end time dari Local Storage
                this.$wire.call('countdownFinished');
                const submitButton = document.getElementById('submit-button');
                if (submitButton) {
                    submitButton.click();
                }
            }
        },

        updateDisplay(remaining = null) {
            if (this.isFinished) return;

            if (remaining === null) {
                remaining = Math.max(0, this.endTime - Date.now());
            }
            const totalSeconds = Math.ceil(remaining / 1000);
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }
    }
}
document.addEventListener('DOMContentLoaded', function () {
    Livewire.on('submitForm', () => {
        // Clear Local Storage
        localStorage.removeItem('countdownEndTime');
        console.log('Local Storage cleared after form submission');
    });
});
</script>
