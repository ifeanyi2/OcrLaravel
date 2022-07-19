@extends('admin.layouts.template')


@section('title', 'OCR')
@section('content')
<div class="container">

    <style>
        input, .card{
            width: 100% !important;
        }
    </style>

    <div class="table-responsive">
      @if(Session('error'))
        {{ $error }}
      @endif
        <form action="{{ route('ocr.save') }}" method="POST">
            @csrf

            <div class="card mb-4 mt-5">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="subjects">subjects</label>
                        <select name="subjects" class="form-control" id="">
                            <option value="" >Select subjects</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ Str::limit($subject->code, 25, '...')    }}</option>
                            @endforeach
                        </select>
                        @error('subjects')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Academic Sesssion</label>
                        <select name="academy_session" class="form-control" id="">
                            <option value="" >Academic Session</option>
                            @foreach($academic_session as $as)
                                <option value="{{ $as->id }}">{{ Str::limit($as->sessionName, 25, '...')    }}</option>
                            @endforeach
                        </select>
                        @error('academy_session')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subjects">Term</label>
                        <select name="term_id" class="form-control" id="">
                            <option value="" >Select Term</option>
                                <option value="1">FIRST TERM</option>
                                <option value="2">SECOND TERM</option>
                                <option value="3">THIRD TERM</option>
                        </select>
                        @error('term_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Class</label>
                                <select name="class_id" class="form-control" id="">
                                    <option value="">Class</option>
                                    @foreach($school_classes as $csl)
                                        <option value="{{ $csl->id }}">{{ $csl->level    }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Group</label>
                                <select class="form-control" id="">
                                    <option value="">Group</option>
                                    @foreach($school_classes as $csl)
                                        <option value="{{ $csl->id }}">{{ $csl->suffix }}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                 
                    <table id="datatablesSimple" class="table bordered mt-5">
                        <thead class="bg-dark text-light">
                            <tr>
                                @foreach($data["data"] as $key => $value)
                                    @if ($loop->first)
                                        @foreach (array_keys($value) as $v)
                                            <th>{{ $v }}</th>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data["data"] as $key => $value)
                                <tr>
                                    @foreach(array_combine(array_keys($value), array_values($value)) as $key => $val)
                                        <td>
                                            <input type="text" class="form-control" name="{{ $key }}[]"  value="{{ $val }}"/>
                                        </td>
                                    @endforeach

                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                <input style="width: 100%" type="submit" class="btn btn-lg btn-primary" value="Submit Score">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
