<?php
include("../../header.php");
?>

<link rel="stylesheet" href="../../style.css">

    <div class="d-flex" id="wrapper">

        <!--sidebar-->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Test
            </div>

            <div class="list-group list-group-flush my-3">

                <a href="./dashboard.php" class="list-group-item list-group-item-action second-text fw-bold active">                    
                    <i class="fas fa-sharp fa-solid fa-lightbulb me-2"></i>Ideas
                </a>

                <a href="../login.php" class="list-group-item list-group-item-action second-text fw-bold">                    
                    <i class="fas fa-sharp fa-regular fa-right-from-bracket me-2"></i>LogOut
                </a>

            </div>
        </div>

        <!--navbar header-->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Ideas</h2>
                </div>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle primary-text fw-bold" href="#" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i>Staff Name
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="#">Profile</a></li>
                              <li><a class="dropdown-item" href="#">Settings</a></li>
                              <li><a class="dropdown-item" href="#">LogOut</a></li>
                            </ul>
                        </li>
                    </ul> 
                </div>
            </nav>

            <!--Content-->
            <div class="container-fluid">


              <div class="card my-3">
                  <div class="card-body">
                    <h5 class="card-title">John Doe</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Posted: March 14, 2023</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Closure Date: March 14, 2023</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Final Closure Date: March 14, 2023</h6>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ullamcorper libero at lacus vulputate, vel molestie odio blandit.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="far fa-thumbs-up me-2"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary"><i class="far fa-thumbs-down me-2"></i></button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" 
                         data-bs-toggle="modal" data-bs-whatever="idea post person" data-bs-target="#replyModal" id="replyBtn">Reply</button>
                      </div>
                    </div>

                    <!--reply content-->
                    <hr class="hr">
                    <div class="d-flex flex-start mt-4">
                      <div class="flex-grow-1 flex-shrink-1">
                        <div>
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                              Simona Disa <span class="small">- 3 hours ago</span>
                            </p>
                          </div>
                          <p class="card-text mb-0">
                            letters, as opposed to using 'Content here, content here',
                            making it look like readable English.
                          </p>
                        </div>                      
                      </div>
                    </div>

                    <hr class="hr">
                    <div class="d-flex flex-start mt-4">
                      <div class="flex-grow-1 flex-shrink-1">
                        <div>
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                              Simona Disa <span class="small">- 3 hours ago</span>
                            </p>
                          </div>
                          <p class="card-text mb-0">
                            letters, as opposed to using 'Content here, content here',
                            making it look like readable English.
                          </p>
                        </div>                      
                      </div>
                    </div>

                  </div>
              </div>                                

                  <!--modal dialog-->
                  <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="replyModalLabel">New message</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="mb-3">
                              <label for="message-text" class="col-form-label">Message:</label>
                              <textarea class="form-control" id="message-text"></textarea>
                              <label class="form-check-label" for="anonymousBox">Anonymous</label>
                              <input class="form-check-input ms-2 me-2" type="checkbox" value="" id="anonymousBox" />                                 
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Send message</button>
                        </div>
                      </div>
                    </div>
                  </div> 

                  


              <!-- <div class="card my-5 py-5">
                <div class="row d-flex flex-start">
                  <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card ms-3 me-3">

                      <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                        <div class="d-flex flex-start w-100">                                
                          <div class="form-outline w-100">
                            <textarea class="form-control" id="textAreaExample" rows="4"
                              style="background: #fff;"></textarea>
                            <label class="form-label" for="textAreaExample">Message</label>
                          </div>
                        </div>
                        <div class="float-end mt-2 pt-1">
                          <label class="form-check-label" for="anonymousBox">Anonymous</label>
                          <input class="form-check-input ms-2 me-2" type="checkbox" value="" id="anonymousBox" />                                 
                          <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                          <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>          -->

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="../../script.js"></script>
    <script src="./js/idea-detail.js"></script>
    

<?php
include("../../footer.php");
?>