<?php 
include_once 'includes/header.php';

// if(isset($_POST['submit'])) {
//   // echo "<script>alert('Button is clicked')</script>";
//   $title = $_POST['title'];
//   $desc = $_POST['description'];

//   $query = "INSERT into about (title, description) values (?,?)";
//   $stmt = $conn->prepare($query);
//   if($stmt) {
//     $stmt->bind_param("ss", $title, $desc);
//     if($stmt->execute()) {
//       echo "<script>alert('Settings uploaded successfully')</script>";
//     } else {
//       echo "<script>alert('Settings upload failed ')</script>";
//     }
//   }
// }

// fetching the about record from the database
$query = "SELECT * from about where id =?";
$id=1;
$stmt = $conn->prepare($query);
if($stmt) {
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $results = $stmt->get_result();
  $about = $results->fetch_assoc();
  // var_dump($about);
}

if(isset($_POST['update'])) {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $id = 1;
  $query = "UPDATE about set title=?, description=? where id = ?";
  $stmt = $conn->prepare($query);
  if($stmt) {
    $stmt->bind_param("ssi", $title, $desc, $id);
    if($stmt->execute()) {
      echo "<script>alert('Settings updated successfully')</script>";
      echo "<script>window.location.href='about.php'</script>";

    } else {
      echo "<script>alert('Settings update failed ')</script>";
    }
  }
}
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <form class="needs-validation" novalidate="" method="POST">
                    <div class="card-header">
                      <h4>About Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>About Title</label>
                                    <input type="text" name="title" class="form-control" required="" value="<?= $about['title']?>">
                                    <div class="invalid-feedback">
                                    Enter the title
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group mb-0 col-md-6">
                              <label>Description</label>
                              <textarea class="form-control" required="" name="description"><?= $about['description']?></textarea>
                              <div class="invalid-feedback">
                                Enter the Description
                              </div>
                            </div>                             
                        </div>
                                   
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" name="update">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php 
include_once 'includes/footer.php';
?>