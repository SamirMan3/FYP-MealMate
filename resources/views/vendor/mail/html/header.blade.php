@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ URL::asset('assets/images/mealmate.jpeg') }}" class="logo" alt="Laravel Logo">
<img src="https://i.ibb.co/vhwrqnr/MealMate.png" alt="MealMate">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
