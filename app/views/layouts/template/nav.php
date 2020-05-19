<?php $activeController = \fw\core\Router::getRoute()['controller'];?>

<div class="bg-dark">
    <div class="container">

        <nav class="navbar navbar-expand-sm navbar-dark">
            <a class="navbar-brand pb-2 <?=$activeController=='Main' ? 'border-bottom border-light px-2' : '';?>" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?=$activeController=='Cats' ? 'active border-bottom border-light' : '';?>">
                        <a class="nav-link" href="/cats">Cats list</a>
                    </li>
                    <li class="nav-item <?=$activeController=='Mail' ? 'active border-bottom border-light' : '';?>">
                        <a class="nav-link" href="/mail">Mail</a>
                    </li>
                    <li class="nav-item <?=$activeController=='TodoList' ? 'active border-bottom border-light' : '';?>">
                        <a class="nav-link" href="/todo-list">To-Do List</a>
                    </li>
                    <li class="nav-item <?=$activeController=='DragAndDrop' ? 'active border-bottom border-light' : '';?>">
                        <a class="nav-link" href="/drag-and-drop">Drag-and-drop</a>
                    </li>
                </ul>

                <div class="form-inline my-2 my-lg-0">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a class="nav-item" href="/user/sign-up">
                            <button type="button" class="btn-sm btn-info border border-light mr-4">
                                SignUp
                            </button>
                        </a>
                        <a class="nav-item" href="/user/login">
                            <button type="button" class="btn-sm btn-primary border border-light">
                                LogIn
                            </button>
                        </a>
                    <?php else : ?>
                        <a class="nav-item nav-link" href="/user/logout">
                            <button type="button" class="btn-sm btn-danger border border-light">
                                LogOut - <b><?= $_SESSION['user']['name']; ?></b>
                            </button>
                        </a>
                    <?php endif; ?>
                </div>

            </div>

        </nav>


    </div>
</div>
