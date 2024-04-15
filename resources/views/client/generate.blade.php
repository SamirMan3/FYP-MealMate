@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            HIM
        @endslot
        @slot('li_2')
            Generate Diet Plan
        @endslot
        @slot('li_3')
            User
        @endslot
        @slot('title')
            Generate Diet Plan
        @endslot
    @endcomponent

    <form action="{{ route('store-diet') }}" id="myForm" method="post" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="id" value="{{ base64_encode($user->id) }}">
        <div class="row p-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Generate Diet Plan fro : {{$user->first_name." ".$user->last_name}}</h4>
                        <p class="text-muted mb-0"> Generate the diet plan for {{$user->first_name." ".$user->last_name}}
                        </p>
                    </div><!--end card-header-->
                    <div class="card-body bootstrap-select-1">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Sunday</label>

                                            <textarea class="form-control" name="sunday">{!!$data?->sunday!!}</textarea>


                                            <span class="text-danger">
                                                @error('sunday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Monday</label>

                                            <textarea class="form-control" name="monday">{!!$data?->monday!!}</textarea>


                                            <span class="text-danger">
                                                @error('monday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Tuesday</label>

                                            <textarea class="form-control" name="tuesday">{!!$data?->tuesday!!}</textarea>


                                            <span class="text-danger">
                                                @error('tuesday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Wednesday</label>

                                            <textarea class="form-control" name="wednesday">{!!$data?->wednesday!!}</textarea>


                                            <span class="text-danger">
                                                @error('wednesday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Thursday</label>

                                            <textarea class="form-control" name="thursday">{!!$data?->thursday!!}</textarea>


                                            <span class="text-danger">
                                                @error('thursday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Friday</label>

                                            <textarea class="form-control" name="friday">{!!$data?->friday!!}</textarea>


                                            <span class="text-danger">
                                                @error('friday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Saturday</label>

                                            <textarea class="form-control" name="saturday">{!!$data?->saturday!!}</textarea>


                                            <span class="text-danger">
                                                @error('saturday')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label font-bold font-16 text-primary">Remarks</label>

                                            <textarea class="form-control" name="remarks">{!!$data?->remarks!!}</textarea>


                                            <span class="text-danger">
                                                @error('remarks')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                </div>



                            </div><!-- end col -->

                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div><!-- end row -->

                        <button class="btn btn-primary text-white" type="submit">Send</button>
                    </div><!-- end card-body -->

                </div> <!-- end card -->
            </div> <!-- end col -->

        </div>

    </form>
@endsection
@section('script')
    <script>
        $('#myForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally



            let isValid = true;
            var toastContainer = $('#warning-toast').find('.toast-container');
            toastContainer.empty();
            var isFirstIteration = true;
            $(this).find('[required]').each(function() {
                $(this).siblings('.error-message').remove();

                if ($(this).val() === '') {
                    isValid = false; // If a required field is empty, set isValid to false
                    $(this).addClass('error'); // Optionally, add a CSS class for styling
                    // $(this).siblings('label').addClass('error'); // Optionally, add a CSS class for styling
                    $(this).siblings('.error-message').remove();
                    var name = $(this).siblings('label').text().trim(); // Get label text
                    if (!name) {
                        name = $(this).attr(
                            'name'); // If label text is empty, get the name attribute
                        var parts = name.split('[question]').filter(Boolean);

                        // Join the parts with spaces
                        var convertedName = parts.join('Question ');
                        convertedName = convertedName.replace(
                            /\[|\]|\_/g, ' ').trim();
                        name = convertedName;
                    }


                    $(this).before(' <span class="error-message error">*' + name +
                        ' is required</span>');
                    if (isFirstIteration) {

                        isFirstIteration = false;
                        var errorPosition = $(this).siblings('.error-message').offset().top;
                        $('html, body').animate({
                            scrollTop: (errorPosition - 50)
                        }, 500);

                        $(this).css('border', '1px solid red');
                        $(this).focus();
                    }
                    var toast = $('#toast-content').first().clone();
                    toast.find('h5').text(
                        `${name} is required`, );
                    toast.removeClass('d-none');
                    toast.toast({
                        autohide: true
                    });
                    var toastContainer = $('#warning-toast').find('.toast-container');
                    toastContainer.children('.toast').hide();
                    toastContainer.append(toast);
                    toastContainer.children('.toast').removeClass('d-none');
                    toastContainer.children('.toast').show({
                        autohide: true
                    });
                    // $(this).css('border', '1px solid yellow');

                } else {
                    $(this).removeClass('error'); // Optionally, add a CSS class for styling
                    $(this).siblings('label').removeClass('error');
                    $(this).siblings('.error-message').remove();
                    $(this).css('border', '').focus();
                    if ($(this).attr('type') === 'email' && !isValidEmail($(this).val())) {
                        var name = $(this).siblings('label').text().trim(); // Get label text
                        if (!name) {
                            name = $(this).attr(
                                'name'); // If label text is empty, get the name attribute
                            var parts = name.split('[question]').filter(Boolean);

                            // Join the parts with spaces
                            var convertedName = parts.join('Question ');
                            convertedName = convertedName.replace(
                                /\[|\]|\_/g, ' ').trim();
                            name = convertedName;
                        }

                        name += ' Invalid email';
                        isValid = false;
                        $(this).before(' <span class="error-message error">*' + name +
                            '</span>');
                        if (isFirstIteration) {

                            isFirstIteration = false;
                            var errorPosition = $(this).siblings('.error-message').offset().top;
                            $('html, body').animate({
                                scrollTop: (errorPosition - 50)
                            }, 500);

                            $(this).css('border', '1px solid red');
                            $(this).focus();
                        }

                    }

                }


            });

            // Call the validation function when the form is submitted
            if (isValid) {

                $('#myForm').unbind('submit').submit();
            } else {
                return false
            }
        });

        function isValidEmail(email) {
            // Use a regular expression to check for a valid email format
            var emailRegex = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;
            return emailRegex.test(email);
        }
    </script>
    <script>
        window.onload = function() {
            setTimeout(function() {
                document.getElementById('password').value = '';
            }, 100);
        }
    </script>
@endsection
