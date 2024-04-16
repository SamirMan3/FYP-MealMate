<x-mail::message>
    Dear Dietician,<br><br>
    Welcome to the MealMate Team!<br><br>
    Thank you for joining the MealMate platform. We're excited to have you on board and look forward to working together to make our hiring process efficient, well-coordinated, and fast.<br><br>
    Your account has been created and is ready for you to set up.<br><br>
    Your credentials are:<br>
    Email: {{$dietician->email}}<br>
    Password: {{$password}}<br><br>
    Here are a few steps to get started:<br>
    - Please indicate the details of the participants in this hiring project and specify which stage(s) of the interview they will be a part of.<br>
    - Outline the skills that you would like the candidates to be evaluated on.<br>
    - You can even provide some guiding questions for your interviewers to ensure that every candidate is evaluated consistently.<br>
    - Indicate the importance of various groups of skills in the evaluation process.<br>
    - Also, indicate the importance of every stage of the interview in the overall calculation of the candidates' scores.<br><br>
    When you're ready, click the button below to login and start managing your hiring process:<br><br>
    <x-mail::button :url="route('index')">Login to MealMate</x-mail::button><br><br>
    Best regards,<br>
    MealMate Team
</x-mail::message>
