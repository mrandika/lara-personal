<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
        crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <title>Admin Dashboard</title>
</head>
@if (Auth::check())

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{asset('image/profile.jpg')}}" class="rounded-circle mx-auto d-block" alt="Cinque Terre"
                    width="50%">
                <h3 class="text-center">{{ Auth::user()->name }}</h3>
            </div>
            <ul class="list-unstyled components">
                <p>Navigation</p>
                <li class="active">
                    <a>
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                            class="fas fa-columns"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Page 1</a>
                        </li>
                        <li>
                            <a href="#">Page 2</a>
                        </li>
                        <li>
                            <a href="#">Page 3</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fas fa-cogs"></i>
                        <span>Configuration</span></a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <div id="content" class="p-5">

                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <svg class="svg-inline--fa fa-align-justify fa-w-14" aria-hidden="true" data-prefix="fas"
                                data-icon="align-justify" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                data-fa-i2svg="">
                                <path fill="currentColor" d="M0 84V44c0-8.837 7.163-16 16-16h416c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16zm16 144h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0-128h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"></path>
                            </svg><!-- <i class="fas fa-align-justify"></i> -->
                        </button>
                        <a href="{{url('posts')}}" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </nav>

                <div class="container">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1>Edit a Post.</h1>
                    <form method="POST" action="{{action('PostController@update', $id)}}">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        @if ($post->featuredImage != null)
                        <img class="p-3" src="{{url('uploads/'.$post->featuredImage)}}" alt="" style="width: 25%">
                        @endif
                        @if ($post->hasFeatured == null)
                        <div class="form-group">
                            <input id="didIHaveFeaturedImage" name="didIHavefeaturedImage" type="checkbox" 
                            <label> Add Featured Image</label>
                            <input id="featuredImage" type="file" class="form-control-file" name="featuredImage" style="display: none">
                        </div>
                        @else
                        <p class="text-danger"><span class="fas fa-exclamation-triangle mr-1"></span>You Cannot Edit the Featured Images.</p>
                        @endif
                        <div class="form-group">
                            <label>Your Post Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $post->title }}">
                        </div>
                        <div class="form-group">
                            <label>Your Post Content</label>
                            <textarea class="form-control" name="content" rows="3">{{ $post->content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Post Category</label>
                            <select class="form-control" name="categories">
                                <option value="1" @if($post->categories==1) selected @endif>Teknologi</option>
                            </select>
                        </div>
                    <input type="text" value="{{ $post->uploadedBy }}" name="author" hidden>
                        <button type="submit" class="btn btn-primary p-2">Edit</button>
                    </form>
                </div>

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
                    crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
                    crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

                <script>
                    $(document).ready(function () {

                        function toggleFields(boxId, checkboxId) {
                            var checkbox = document.getElementById(checkboxId);
                            var box = document.getElementById(boxId);
                            checkbox.onclick = function () {
                                console.log(this);
                                if (this.checked) {
                                    box.style['display'] = 'block';
                                } else {
                                    box.style['display'] = 'none';
                                }
                            };
                        }
                        toggleFields('featuredImage', 'didIHaveFeaturedImage');

                        $('#sidebarCollapse').on('click', function () {
                            $('#sidebar').toggleClass('active');
                            $('.collapse.in').toggleClass('in');
                            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                        });

                    });
                </script>
</body>
@else

@endif

</html>