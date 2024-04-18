<x-mail::message>
    Dear Dietician,<br><br>
    Welcome to the MealMate Team!<br><br>
    Thank you for joining the MealMate platform. We're excited to have you on board and look forward to working together to make our working process efficient, well-coordinated, and fast.<br><br>
    Your account has been created and is ready for you to set up.<br><br>
    Your credentials are:<br>
    Email: {{$dietician->email}}<br>
    Password: {{$password}}<br><br>
    Here are a few steps to get started:<br>
    - Please do change your password form the setting option for added confidentiality.<br>
    - The clients that have opted you will appear on your dashboard.<br>
    - Indicate the importance of Strictly following the recommended diet plan.<br>
    - Stay updated with the latest research and trends in nutrition and dietetics to provide evidence-based recommendations to your clients. <br><br>
    When you're ready, click the button below to login and start recommending diets to our users:<br><br>
    <x-mail::button :url="route('index')">Login to MealMate</x-mail::button><br><br>
    Best regards,<br>
    MealMate Team
</x-mail::message>
