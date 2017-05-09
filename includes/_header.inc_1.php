<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      <?php echo (isset($page_title)) ? $page_title : 'Knowledge is Power: And It Pays to Know'; ?>
    </title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-fixed-top">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span
          </button>
          <a class="navbar-brand" href="./index.php">Knowledge is Power</a>
          <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                  $pages = array(
                    "Home" => "index.php",
                    "About" => "#",
                    "Contact" => "#"
                  );
                  if (!isset($_SESSION['user_id'])) $pages["Register"] = "register.php";

                  $this_page = basename($_SERVER['PHP_SELF']);
                  foreach ($pages as $title => $page) {
                    echo ($page == $this_page) ? "<li class='active'>" : "<li>";
                    echo "<a href='$page'>$title</a></li>\n";
                  }
                  if (isset($_SESSION['user_id'])) {
                    echo <<<END
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Account <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
END;
                    $pages = array(
                      "Logout" => "logout.php",
                      "Renew" => "renew.php",
                      "Change Password" => "change_password.php",
                      "Favorites" => "favorites.php",
                      "Recommendations" => "recommendations.php"
                    );
                    foreach ($pages as $title => $page) {
                      echo ($page == $this_page) ? "<li class='active'>" : "<li>";
                      echo "<a href='$page'>$title</a></li>\n";
                    }
                    echo <<<END
                </ul>
              </li>
END;
                    
                    if (isset($_SESSION['user_admin'])) {
                      echo <<<END
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                <ul class="dropdown-menu">
END;
                      $pages = array(
                        "Add Page" => "add_page.php",
                        "Add PDF" => "add_pdf.php"
                      );
                      foreach ($pages as $title => $page) {
                        echo ($page == $this_page) ? "<li class='active'>" : "<li>";
                        echo "<a href='$page'>$title</a></li>\n";
                      }
                      echo <<<END
                </ul>
              </li>
END;
                  }
                }
              ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/container-->
      </div><!--/navbar-->

      <!-- Begin page content -->
      <div class="container">
        <div class="row">
          <div class="col-3">
	    <h3 class="text-success">Content</h3>
	    <div class="list-group">
                <?php
                    $q = "SELECT * FROM categories ORDER BY category";
                    $r = mysqli_query($dbc, $q);
                    while (list($id, $category) = mysqli_fetch_array($r, MYSQLI_NUM)) {
                        echo "<a href='category.php?id=$id' class='list-group-item' " . 
                                "title='$category'>" . htmlspecialchars($category) . "</a>";
                    }
                ?>
                <a href="pdfs.php" class="list-group-item"><span class="badge">5</span>PDF Guides</a>
            </div><!--/list-group-->
                        
            <?php
                if (!isset($_SESSION['user_id'])) {
                  if ($this_page === 'forgot_password.php') {
                    require("includes/forgot_password/_form.inc.php");
                  } else {
                    require("includes/login/_form.inc.php");
                  }
                }
            ?>

          </div><!--/col-3-->
	  <div class="col-9">

			