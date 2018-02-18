

function QuestionCount() {
    var countQuestions = 0;

    return {
        inc: function () {
            return countQuestions++;
        },
        current: function () {
            return countQuestions;
        },
        reset: function () {
            countQuestions = 0;
            return countQuestions;
        }
    };
}

var count = QuestionCount();

function addQuestion() {
    var cont = document.createElement('div');
    var createQuize = document.getElementById('add_quize');
    cont.className = "form-group col-md-6 mx-auto";
    var form = document.getElementById('newQuizForm');
    form.insertBefore(cont, createQuize);
    var questionLabel = document.createElement('label');
    count.inc();
    questionLabel.innerHTML = "Питання № " + count.current();
    var saveCurrent = count.current();
    cont.appendChild(questionLabel);
    var questionName = document.createElement('input');
    questionName.type = 'text';
    questionName.className = 'form-control';
    questionName.setAttribute('placeholder', 'Введіть питання');
    questionName.setAttribute('required', '');
    questionName.setAttribute('name', 'question'+count.current());
    cont.appendChild(questionName);
    var anscont = document.createElement('div');
    anscont.className = ('form-group col-md-6');
    cont.appendChild(anscont);
    var ansfieldset = document.createElement('fieldset');
    ansfieldset.className = ('form-group');
    anscont.appendChild(ansfieldset);
    anscont.innerHTML = ' <legend>Варіанти відповіді</legend>';
    var ansnumber = document.createElement('div');
    ansnumber.className = 'form-check';
    anscont.appendChild(ansnumber);
    var ansLabel = document.createElement('label');
    ansLabel.className='form-check-label';
    ansnumber.appendChild(ansLabel);
    var radio = document.createElement('input');
    radio.type = 'radio';
    radio.className = 'form-check-input';
    ansLabel.appendChild(radio);
    var ansname = document.createElement('input');
    ansname.type = 'text';
    ansname.className = 'form-control col-md-12';
    ansname.setAttribute('placeholder', 'Введіть варіант відповіді');
    ansname.setAttribute('required','');
    var countAnswers = QuestionCount();
    countAnswers.inc();
    ansname.setAttribute('name','answer'+count.current()+'.'+countAnswers.current());
    countAnswers.inc();
    ansnumber.appendChild(ansname);
    var addAnswer = document.createElement('button');
    addAnswer.className = 'btn btn-info btn-sm';
    addAnswer.type = 'button';
    addAnswer.innerHTML = 'Додати ще варіант';
    addAnswer.style = 'margin: 10px 0 0 70px;';
    anscont.appendChild(addAnswer);
    function  addAnswerVariant() {
        var newAns = ansnumber.cloneNode(true);
        newAns.querySelector('input[type="text"]').setAttribute('name', 'answer'+saveCurrent+'.'+countAnswers.inc());
        anscont.insertBefore(newAns, addAnswer);
    }
    addAnswer.addEventListener('click', addAnswerVariant);


}

var addQuestionBtn = document.getElementById('add_question');
addQuestionBtn.addEventListener('click', addQuestion);
