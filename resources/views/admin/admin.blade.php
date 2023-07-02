@extends('layouts.app_layout')
<link rel="stylesheet" href="{{ asset('css/pages/admin.css') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/css/bootstrap.min.css">
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h1 class="main_title">
                <i class="fa-solid fa-folder-gear"></i> Administration
            </h1>
        </div>
        @if(session('success_news_store'))
            <div class="alert alert-success">
                {{ session('success_news_store') }}
            </div>
        @endif
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#members"><i class="fa-solid fa-user"></i> Membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#posts"><i class="fa-solid fa-paste"></i> Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#comments"><i class="fa-solid fa-comments"></i> Commentaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#news"><i class="fa-solid fa-newspaper"></i> Actualités</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#reports"><i class="fa-solid fa-triangle-exclamation"></i> Rapports & Alertes</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show" id="members">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des membres</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>ID</th>
                                    <th>Pseudo</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr class="user-row">
                                        <td><img src="{{ asset('storage/images/users/profile/' . $user->avatar) }}" alt="" class="post_img" style="object-fit: cover; width: 30px; height: 30px;"></td>
                                        <td>{{ $user->id }}</td>
                                        <td class="name-cell">{{ $user->name }}</td>
                                        <td>{{ $user->last_name }} {{ $user->first_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role_name }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <button class="btn btn-warning update-user-btn" data-user-id="{{ $user->id }}">Modifier</button>
                                            @if($user->is_active)
                                                <button class="btn btn-danger disable-user-btn" data-user-id="{{ $user->id }}" data-action-url="{{ route('user.reactivate', $user->id) }}">Désactiver</button>
                                            @else
                                                <button class="btn btn-success activate-user-btn" data-user-id="{{ $user->id }}" data-action-url="{{ route('user.disable', $user->id) }}">Réactiver</button>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="edit-form-row" style="display: none;">
                                        <td colspan="8">
                                            <form class="edit-form" method="POST">
                                                @method('POST')
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Pseudo</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="first_name" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="last_name" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Rôle</label>
                                                    <select class="form-select" id="role" name="role">
                                                        <option value="1" {{ $user->role_id === 1 ? 'selected' : '' }}>Admin</option>
                                                        <option value="2" {{ $user->role_id === 2 ? 'selected' : '' }}>Modérateur</option>
                                                        <option value="3" {{ $user->role_id === 3 ? 'selected' : '' }}>Utilisateur</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary save-changes-btn">Enregistrer les modifications</button>
                                                <button type="button" class="btn btn-secondary cancel-changes-btn">Annuler</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="posts">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des posts</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Contenu</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($posts as $post)
                                    <tr class="post-row">
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user_name }}</td>
                                        <td>{{ $post->title }}</td>
                                      <td>  {!! nl2br(htmlspecialchars(mb_substr($post->message, 0, 10) . (mb_strlen($post->message) > 10 ? '...' : ''))) !!}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <button class="btn btn-primary show-post-btn" id="show-post-btn">Voir tout</button>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".show-post-btn").click(function() {
                                                        var buttonText = $(this).text();
                                                        if (buttonText === "Voir tout") {
                                                            $(this).text("Réduire");
                                                        } else {
                                                            $(this).text("Voir tout");
                                                        }
                                                    });
                                                });

                                            </script>
                                            <button class="btn btn-danger delete-post-btn" data-post-id="{{ $post->id }}">Supprimer</button>
                                            <button class="btn btn-secondary hide-post-btn" data-post-id="{{ $post->id }}">Masquer</button>
                                        </td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="6">
                                            <div class="details-content">
                                                <u><b><h4>Titre:</h4></b></u>
                                                <p>{{ $post->title }}</p>
                                                <u><b><h4>Contenu:</h4></b></u>
                                                <p>{{ $post->message }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="comments">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des commentaires</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Post</th>
                                    <th>Commentaire</th>
                                    <th>Auteur</th>
                                    <th>Date de publication</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($comments as $comment)
                                    <tr class="comment-row">
                                        <td>{{ $comment->id }}</td>
                                        <td>{!! nl2br(htmlspecialchars(mb_substr($comment->post_title, 0, 10) . (mb_strlen($comment->post_title) > 10 ? '...' : ''))) !!}</td>
                                        <td>{!! nl2br(htmlspecialchars(mb_substr($comment->message, 0, 10) . (mb_strlen($comment->message) > 10 ? '...' : ''))) !!}</td>
                                        <td>{{ $comment->author_name }}</td>
                                        <td>{{ $comment->created_at }}</td>
                                        <td>
                                            <button class="btn btn-primary show-comment-btn" id="show-comment-btn">Voir tout</button>
                                            <script>
                                                $(document).ready(function() {
                                                    $(".show-comment-btn").click(function() {
                                                        var buttonText = $(this).text();
                                                        if (buttonText === "Voir tout") {
                                                            $(this).text("Réduire");
                                                        } else {
                                                            $(this).text("Voir tout");
                                                        }
                                                    });
                                                });

                                            </script>
                                            <button class="btn btn-danger delete-comment-btn" data-comment-id="{{ $comment->id }}">Supprimer</button>
                                            <button class="btn btn-secondary hide-post-btn" data-comment-id="{{ $comment->id }}">Masquer</button>
                                        </td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="6">
                                            <div class="details-content">
                                                <u><b><h4>Titre du post:</h4></b></u>
                                                <p>{{ $comment->post_title }}</p>
                                                <u><b><h4>Commentaire:</h4></b></u>
                                                <p>{{ $comment->message }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="news">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des actualités</h3>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="text-light">Liste des actualités</h5>
                            <table class="table table-hover table-dark">
                                <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr class="post-row">
                                        <td>{!! nl2br(htmlspecialchars(mb_substr($new->title, 0, 15) . (mb_strlen($new->title) > 15 ? '...' : ''))) !!}</td>
                                        <td>{{ $new->user_name }}</td>
                                        <td>
                                            <button class="btn btn-primary show-news-btn" id="show-news-btn"><i class="fa-solid fa-hand-pointer"></i></button>
                                            <button class="btn btn-danger delete-news-btn" data-news-id="{{ $new->id }}"><i class="fa-solid fa-trash"></i></button>
                                            <button class="btn btn-secondary hide-news-btn" data-post-id="{{ $new->id }}"><i class="fa-solid fa-eye-slash"></i></button>
                                        </td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="6">
                                            <div class="details-content">
                                                <u><b><h4>Titre:</h4></b></u>
                                                <p>{{ $new->title }}</p>
                                                <u><b><h4>Contenu:</h4></b></u>
                                                <p>{{ $new->content }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="col-6">
                            <h5 class="text-light">Poster une actualité</h5>
                            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title" class="text-light">Titre :</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="content" class="text-light">Contenu :</label>
                                    <textarea name="content" id="content" class="ckeditor form-control" rows="5" required></textarea>

                                </div>

                                <div class="form-group">
                                    <label for="image" class="text-light">Image :</label>
                                    <input type="file" name="image" id="image" class="form-control-file">
                                </div>

                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="reports">
                    <div class="row mt-5">
                        <h3 class="section_main_title">Gestion des rapports et des alertes</h3>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped table-dark">
                                <thead>
                                <tr>
                                    <th>Auteur</th>
                                    <th>Titre</th>
                                    <th>Rapport</th>
                                    <th>Date de publication</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($reports as $report)
                                    <tr class="report-row">
                                       @if(!$report->name)
                                            <td>SYSTEM</td>
                                        @else
                                            <td>{{ $report->name }}</td>
                                       @endif
                                        <td>{!! nl2br(htmlspecialchars(mb_substr($report->title, 0, 25) . (mb_strlen($report->title) > 10 ? '...' : ''))) !!}</td>
                                        <td>{!! nl2br(htmlspecialchars(mb_substr($report->message, 0, 25) . (mb_strlen($report->message) > 10 ? '...' : ''))) !!}</td>
                                        <td>{{ $report->created_at }}</td>
                                    </tr>
                                    <tr class="details-row">
                                        <td colspan="4">
                                            <div class="details-content">
                                                <u><b><h4>Titre:</h4></b></u>
                                                <p>{{ $report->title }}</p>
                                                <u><b><h4>Rapport</h4></b></u>
                                                <p>{{ $report->message }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.ckeditor').ckeditor();
    });
</script>
<script>
    $(document).ready(function() {
        $(".update-user-btn").click(function() {
            var userId = $(this).data("user-id");
            var editFormRow = $(this).closest("tr").next(".edit-form-row");

            $(".edit-form-row").not(editFormRow).hide();
            editFormRow.toggle();
        });

        $(".edit-form").submit(function(e) {
            e.preventDefault();
            var userId = $(this).closest(".edit-form-row").prev().find(".update-user-btn").data("user-id");
            var form = $(this);

            var name = form.find("#name").val();
            var firstName = form.find("#first_name").val();
            var lastName = form.find("#last_name").val();
            var email = form.find("#email").val();
            var role = form.find("#role").val();

            $.ajax({
                url: "/admin/update/user/" + userId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    name: name,
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    role: role
                },
                success: function(response) {
                    console.log("Mise à jour réussie");
                    $(".name-cell[data-user-id='" + userId + "']").text(name);
                    var url = window.location.href.split('#')[0] + "#members";
                    window.location.href = url;
                    location.reload();
                    localStorage.setItem('success_user_update', 'Mise à jour réussie !');
                },
                error: function(xhr, status, error) {
                    console.log("Erreur lors de la mise à jour : " + error);
                }
            });
        });

        var successMessage = localStorage.getItem('success_user_update');
        if (successMessage) {
            var alertDiv = $('<div>').addClass('alert alert-success').text(successMessage);
            $('.main_title').after(alertDiv);
            localStorage.removeItem('success_user_update');
        }
    });
</script>


<script>
    $(document).ready(function() {
        $(".toggle-edit-form-btn").click(function() {
            var userId = $(this).data("user-id");
            var editFormRow = $(this).closest("tr").next(".edit-form-row");

            $(".edit-form-row").not(editFormRow).hide();

            editFormRow.toggle();
        });

        $(".cancel-changes-btn").click(function() {
            var editFormRow = $(this).closest(".edit-form-row");
            editFormRow.hide();
        });

        $(".edit-form").submit(function(e) {
            e.preventDefault();

        });
    });

</script>

<script>
    $(document).ready(function() {
        $(".delete-post-btn").click(function() {
            var postId = $(this).data("post-id");
            var deleteButton = $(this);

            $.ajax({
                url: "/posts/delete/" + postId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    deleteButton.closest(".post-row").next(".details-row").remove();
                    deleteButton.closest(".post-row").remove();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
        $(".delete-comment-btn").click(function() {
            var commentId = $(this).data("comment-id");
            var deleteButton = $(this);

            $.ajax({
                url: "/comment/delete/" + commentId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    deleteButton.closest(".comment-row").next(".details-row").remove();
                    deleteButton.closest(".comment-row").remove();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
        $(".delete-news-btn").click(function() {
            var newsId = $(this).data("news-id");
            var deleteButton = $(this);

            $.ajax({
                url: "/news/delete/" + newsId,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    deleteButton.closest(".post-row").next(".details-row").remove();
                    deleteButton.closest(".post-row").remove();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>



<script>
    $(document).ready(function() {
        $(".details-row").hide();
        $(".report-row").click(function() {
            $(".details-row").not($(this).next()).slideUp();
            $(this).next().slideToggle();
        });
    });

    $(document).ready(function() {
        $(".details-row").hide();
        $(".show-comment-btn").click(function() {
            $(this).closest(".comment-row").next(".details-row").slideToggle();
        });
    });

    $(document).ready(function() {
        $(".details-row").hide();
        $(".show-post-btn").click(function() {
            $(this).closest(".post-row").next(".details-row").slideToggle();
        });
    });
    $(document).ready(function() {
        $(".show-news-btn").click(function() {
            $(this).closest(".post-row").next(".details-row").slideToggle();
        });
    });

</script>

<script>
    $(".hide-post-btn").click(function() {
        var postId = $(this).data("post-id");

        $.ajax({
            url: "/posts/" + postId + "/hide",
            type: "PUT",
            success: function(response) {
                $(this).closest(".post-row").next(".details-row").toggle();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $(".disable-user-btn, .activate-user-btn").click(function() {
            var userId = $(this).data("user-id");
            var button = $(this);
            var isActive = button.hasClass("btn-success");
            var actionUrl;

            if (isActive) {
                actionUrl = "/users/" + userId + "/reactivate";
            } else {
                actionUrl = "/users/" + userId + "/disable";
            }

            $.ajax({
                url: actionUrl,
                type: "PUT",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log("Opération réussie !");

                    if (isActive) {
                        button.text("Désactiver");
                        button.removeClass("btn-success").addClass("btn-danger");
                        button.data("is-active", 0);
                    } else {
                        button.text("Réactiver");
                        button.removeClass("btn-danger").addClass("btn-success");
                        button.data("is-active", 1);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>

