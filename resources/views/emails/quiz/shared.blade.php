@component('mail::message')
# Bonjour,

{{ $sender->name }} vous a partagé un quiz intitulé : **{{ $quiz->title }}**

@component('mail::button', ['url' => route('quiz.evaluate', $quiz->id)])
📘 Accéder au quiz
 Evaluez os competences en **{{ $quiz->title }}**
@endcomponent

Merci d’utiliser EasyLearning !

@endcomponent

