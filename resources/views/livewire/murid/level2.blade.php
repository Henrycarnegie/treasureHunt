@section('title', 'Level 2')

<form wire:submit.prevent="simpanJawaban"
class="overflow-hidden min-h-screen flex flex-col gap-8 lg:gap-12 xl:gap-20 items-center justify-center w-full h-full bg-no-repeat bg-cover bg-gradient-to-r from-slate-700 to-zinc-700 py-12 px-6 lg:px-20 xl:px-60 relative"
x-data="{
        currentQuestion: 1,
        totalQuestions: {{ $data->count() }},
        answeredQuestions: @entangle('answeredQuestions'),

        nextQuestion() {
            if (this.currentQuestion < this.totalQuestions) {
                let nextQ = $wire.getNextUnansweredQuestion(this.currentQuestion);
                this.currentQuestion = nextQ;
            }
        },

        isQuestionAnswered(questionId) {
            return this.answeredQuestions.includes(questionId);
        }
    }">
    <x-murid.layout-level infoLevel="2" :data="$data" :endTime="$endTime" :startTime="$startTime" :levelTimeLeft="$countdown" :display="$display"></x-murid.layout-level>
</form>
