<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body dir="rtl">
    <div style="border:1px solid #e2e2e2; ">
        <h1>{{ $survey->question }}</h1>
        <h1>تعداد پاسخ های ارسال شده: {{ $answerCount }}</h1>
        <h2>بیشترین انتخاب:         {{ $popularMedia->name }}  با {{ $mostPopularAnswer->count }} رای </h2>
        <a href="{{ route('doApplySurvey') }}/?id={{ $survey->id }}" onclick="return confirm('آیا می خواهید امتیاز ها اعمال شود؟')">اعمال امتیاز ها</a>
    </div>


      {{ $meessage }}

</body>
</html>