@section('title', 'Level 1')

<x-murid.layout-level infoLevel="1" :levelTimeLeft="$countdown" :display="$display"></x-murid.layout-level>

<script>
    function countdown(levelTimeLeft) {
        return {
            display: '00:00',
            endTime: Date.now() + Math.max(0, parseInt(levelTimeLeft) * 60 * 1000),
            intervalId: null,
            isFinished: false,

            init() {
                console.log('Countdown initialized');
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
                }, 100); // Update setiap 100ms
            },

            finishCountdown() {
                if (!this.isFinished) {
                    console.log('Countdown finished');
                    this.isFinished = true; // Set flag ke true
                    clearInterval(this.intervalId); // Hentikan interval
                    this.display = '00:00'; // Set display ke 00:00
                    this.$wire.call('countdownFinished'); // Panggil fungsi Livewire
                }
            },

            updateDisplay(remaining = null) {
                if (this.isFinished) return; // Jangan update display jika sudah selesai

                if (remaining === null) {
                    remaining = Math.max(0, this.endTime - Date.now());
                }
                const totalSeconds = Math.ceil(remaining / 1000);
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                this.display = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                console.log('Display updated:', this.display);
            }
        }
    }
</script>
