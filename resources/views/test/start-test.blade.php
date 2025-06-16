@extends('layout.dashboard')

@section('content')
<style>
    :root {
        --primary-color: #2ca086;
        --primary-hover: #239176;
        --light-bg: #f8f9fa;
        --option-hover: #e0f5ef;
    }

    .question-box {
        background-color: var(--light-bg);
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-top: 20px;
    }

    .question-text {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .options label {
        display: block;
        padding: 10px 15px;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    .options input[type="radio"] {
        margin-right: 10px;
        accent-color: var(--primary-color); 
    }

    .options label:hover {
        background-color: var(--option-hover);
        border-color: var(--primary-color);
    }

    .timer {
        font-size: 18px;
        font-weight: 500;
        margin-top: 20px;
        color: #dc3545;
    }

    .question-progress {
        font-weight: 500;
        margin-top: 10px;
        color: #6c757d;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
    }

    .text-primary {
        color: var(--primary-color) !important;
    }
</style>

<div class="container my-5">
    <h2 class="mb-4 text-primary">  Tes TIU Online</h2>

    <form id="test-form" action="/test/submit" method="POST">
        @csrf
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="question-progress">
                Soal <span id="current-index">1</span> dari {{ $totalQuestions ?? 30 }}
            </div>
            <div class="timer" id="timer">Waktu: 1:00</div>
        </div>
        <div id="question-container"></div>
        <div id="hidden-answers-container"></div>
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-primary me-2" id="next-button" onclick="nextQuestion()">Soal Selanjutnya</button>
            <button type="submit" class="btn btn-success" id="submit-button" style="display: none;">Selesai & Submit</button>
        </div>
    </form>
<div class="modal fade" id="exitModal" tabindex="-1" aria-labelledby="exitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exitModalLabel">Peringatan!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Silakan selesaikan tes terlebih dahulu sebelum meninggalkan halaman ini.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

</div>

<script>
    
    let currentQuestionIndex = 0;
    let timer = 60;
    let timerInterval;
    let totalQuestions = {{ $totalQuestions ?? 30 }};
    let questions = @json($questions);

    document.addEventListener('DOMContentLoaded', function () {
        displayQuestion(questions[currentQuestionIndex]);
        startTimer();
        updateProgress();
    });
window.addEventListener('beforeunload', function (e) {
    e.preventDefault();
    e.returnValue = '';
});
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('a');

    links.forEach(link => {
        const href = link.getAttribute('href');
        if (href && !href.startsWith('#') && !href.startsWith('javascript:') && !href.includes('/test/submit')) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const modal = new bootstrap.Modal(document.getElementById('exitModal'));
                modal.show();
            });
        }
    });
});

    function displayQuestion(soal) {
        const questionContainer = document.getElementById('question-container');

      
        let savedValue = '';
        const hiddenInput = document.querySelector(`input[name="answers[${soal.id}]"]`);
        if (hiddenInput) {
            savedValue = hiddenInput.value;
        }

        questionContainer.innerHTML = `
            <div class="question-box">
                <img src="/images/keterangan.png" alt="Keterangan Soal" class="img-fluid mb-3" style="width:90%;">
                <img src="/${soal.image}" alt="Soal Gambar" class="img-fluid rounded shadow-sm mb-3" style="width:90%;"><br>

                <div class="options">
                    ${[1, 2, 3, 4, 5].map(val => `
                        <label>
                            <input type="radio" name="question_option" value="${val}" ${savedValue == val ? 'checked' : ''}>
                            ${val}
                        </label>
                    `).join('')}
                </div>
            </div>
        `;
    }

    function updateProgress() {
        document.getElementById('current-index').innerText = currentQuestionIndex + 1;
    }

    function startTimer() {
        const timerElement = document.getElementById('timer');
        timer = 60;
        if (timerInterval) clearInterval(timerInterval);
        timerInterval = setInterval(function () {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;
            timerElement.textContent = `Waktu: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            timer--;
            if (timer < 0) {
                clearInterval(timerInterval);
                nextQuestion();
            }
        }, 1000);
    }

    function nextQuestion() {
    const selectedOption = document.querySelector('input[name="question_option"]:checked');
    if (!selectedOption) {
        alert("Silakan pilih jawaban terlebih dahulu sebelum melanjutkan ke soal berikutnya.");
        return; 
    }
    const currentQuestion = questions[currentQuestionIndex];
    let hiddenInput = document.querySelector(`input[name="answers[${currentQuestion.id}]"]`);
    if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `answers[${currentQuestion.id}]`;
        document.getElementById('hidden-answers-container').appendChild(hiddenInput);
    }
    hiddenInput.value = selectedOption.value;
    if (currentQuestionIndex + 1 < questions.length) {
        currentQuestionIndex++;
        displayQuestion(questions[currentQuestionIndex]);
        updateProgress();
        startTimer();
    } else {
        document.getElementById('next-button').style.display = 'none';
        document.getElementById('submit-button').style.display = 'inline-block';
        clearInterval(timerInterval);
    }
}
    document.getElementById('test-form').onsubmit = function () {
        const hiddenInputs = document.querySelectorAll('#hidden-answers-container input');
        if (hiddenInputs.length < totalQuestions) {
            alert("Harap jawab semua pertanyaan sebelum submit.");
            return false;
        }
        return true;
    };
</script>
@endsection
