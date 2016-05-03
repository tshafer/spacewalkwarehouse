@extends('frontend.fitfest.layout')

@section('content')
    <h1>Register for FitFest</h1>
    <article id="content-container">
        {!! open(['route' => 'fitfest.store', 'method' => 'POST', 'files' => true, 'class' => 'fitfest_form']) !!}
        <p>Thank you for purchasing a ticket to this year’s Fit Fest! You are able to sign up for up to three classes,
            please select them below and hit submit. Classes fill up quickly so please sign up as soon as you can.
            Looking forward to seeing you on May 1st!</p>
        <div class="row">
            <div class="col-md-12">
                @include('flash::messages')

                <div class="form-group">
                    {!!label('First Name')!!}
                    {!!text('first_name',old('first_name'),['class' => 'form-control', 'required'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('Last Name')!!}
                    {!!text('last_name',old('first_name'),['class' => 'form-control', 'required'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('Email')!!}
                    {!!text('email',old('email'),['class' => 'form-control', 'required'])!!}
                </div>

                <div class="schedule">
                    {!!label('Schedule')!!}
                    <br/>
                    <i>Click on the classes you would like to take.</i>
                    <br/><br/>
                    <div class="bold">
                        <table style="width: 100%">
                            <tr>
                                <td></td>
                                <td style="text-align:center; font-weight:bold;" colspan="3">Studio 1</td>
                                <td style="text-align:center; font-weight:bold;" colspan="3">Studio 2</td>
                                <td style="text-align:center; font-weight:bold;" colspan="3">Studio 3</td>
                                <td style="text-align:center; font-weight:bold;" colspan="3">Studio 4</td>
                                <td style="text-align:center; font-weight:bold;" colspan="3">Studio 5</td>
                            </tr>

                            @foreach($times as $time)
                                <tr class="centerWhite">
                                    <td class="td {{$time->class}} date">{{$time->start_date->format('g:i a')}}
                                        @if($time->end_date != '-0001-11-30 00:00:00')
                                            - {{$time->end_date->format('g:i a')}}
                                        @endif
                                    </td>

                                    @foreach($time->fitClass as $classes)
                                        <td class="td {{$classes->class}}
                                        @if($classes->max_students - $classes->students->count() > 0) class @endif"
                                            colspan="{{15/$time->fitClass->count()}}" data-classid="{{$classes->id}}"
                                            data-students="{{ $classes->max_students - $classes->students->count()}}">{{$classes->name}}
                                            @if($classes->max_students !=0)
                                                <br/>
                                                @if($classes->max_students - $classes->students->count() == 0)
                                                    Closed
                                                @else
                                                    ({{ $classes->max_students - $classes->students->count() }} spots open)
                                                @endif
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h2><b>Selected Courses:</b></h2>
                    <span class="no_selected_courses">No Courses Selected</span>
                    <ul id="selected_courses">
                    </ul>
                </div>

                <div class="form-group">
                    {!! submit('Register', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!!close()!!}
        </div>

    </article>
@endsection

@section('scripts')
    <script type="text/javascript">

        /**
         *
         * @param arr
         * @param className
         * @returns {number}
         */


        function findIdByClass(arr, id) {
            for (var i = 0; i < arr.length; ++i) {
                var obj = arr[i];
                if (obj.id == id) {
                    return id;
                }
            }
            return -1;
        }

        function findItemByDate(arr, date) {
            for (var i = 0; i < arr.length; ++i) {
                var obj = arr[i];
                if (obj.date == date) {
                    return 1;
                }
            }
            return -1;
        }


        $(function () {
            var selectedClasses = $('#selected_courses');
            var fitfestForm = $('.fitfest_form');
            var classes = [];
            $('.class').click(function () {

                $('.no_selected_courses').hide();
                var $that = $(this),
                        date = $that.parent().find('td.date').text(),
                        classId = $that.data('classid'),
                        foundClassId = findIdByClass(classes, classId);

                if (findItemByDate(classes, date) != -1 && foundClassId != classId) {
                    return false;
                }

                if ($that.data('students') == 0) {
                    sweetAlert("Class Full", "This class is full. Please choose another class.", "error");
                    return false;
                }

                if (classes.length != 3 && foundClassId == -1) {

                    $that.addClass('added');
                    classes.push({'date': date, 'class': $that.text(), 'id': classId});
                } else if (foundClassId == classId) {

                    for (var i = 0; i < classes.length; i++) {
                        if (classes[i].id && classes[i].id === classId) {
                            classes.splice(i, 1);
                            break;
                        }
                    }
                    $that.removeClass('added');
                }
                selectedClasses.html('');
                $('.classesHidden').remove();
                classes.forEach(function (item) {
                    selectedClasses.append('<li class="blueText">' + item.date + ' - ' + item.class + '</li>');
                    fitfestForm.append('<input type="hidden" class="classesHidden" name="class[' + item.id + ']" value="' + item.id + '"/>')
                })
            })
        });
    </script>
@endsection

@section('styles')
    <style type="text/css">
        #selected_courses {
            list-style-type: decimal;
            height: 100px;
            margin: 0px;
            padding: 0px;

        }

        #selected_courses li {
            margin-left: 20px;
            padding: 10px 0 0 0;
        }

        .class {
            position: relative;
        }

        .centerWhite {
            text-align: center;
            color: #fff;
        }

        .td {
            padding: 10px;
            border: 3px solid #fff;
            width: 157px;
        }

        .blue {
            background: #00acc7
        }

        .blueText {
            color: #00acc7
        }

        .pink {
            background: #ea1971;
        }

        .orange {
            background: #f8a231;
        }

        .green {
            background: #5cc2b9;
        }

        .added {
            background: #008000
        }

        .red {
            color: red;
        }

    </style>

@endsection