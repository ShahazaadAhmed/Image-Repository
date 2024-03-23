<?php
session_start();
if (!isset($_SESSION['UN'])) {
  header("location:../index.php");
  exit;
}
$string = $_SESSION['spz'];
$pattern = '/(.+)(pest|disease)/';

if (preg_match($pattern, $string, $matches)) {
  $b = $matches[1];
  $pe = $matches[2];
} else {
  echo "No match found.";
}

require '../DBinfo.php';
// #########################################################################################################    
// author: Satya Sreekar Pattaswami
// last change:
//             made changes to the redirections as to accomodate for the implementation of the directories.
//             In this page only the header to index page and the DBinfo have been changed 
// last cahnge date: 29 February 2023
// email: satyasreekarpattaswami@gmail.com
// description:
//             This is a php-html combination file. This page is for the displaying the data in the table 
//             "tempdb" based on the approver privilage and give them the option to approve, reject or edit
//              and approve the entries. For further details refer to the documentation section 4.4.1 .
#########################################################################################################

// Get filter values from query parameters or set default values
$userFilter = isset($_GET['user']) ? $_GET['user'] : '';
$cropFilter = isset($_GET['crop']) ? $_GET['crop'] : '';
$monthFilter = isset($_GET['month']) ? $_GET['month'] : '';
$yearFilter = isset($_GET['year']) ? $_GET['year'] : '';
$stageFilter = isset($_GET['stage']) ? $_GET['stage'] : '';
$partsFilter = isset($_GET['parts']) ? $_GET['parts'] : '';
$seasonFilter = isset($_GET['season']) ? $_GET['season'] : '';
$stateFilter = isset($_GET['state']) ? $_GET['state'] : '';
$pordFilter = isset($_GET['pord']) ? $_GET['pord'] : '';

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // Build the SQL query with filters
  $sql = "SELECT * FROM tempdb WHERE 1=1";

  if (!empty($userFilter)) {
    $sql .= " AND `User` = :user";
  }
  if (!empty($cropFilter)) {
    $sql .= " AND `CROP` = :crop";
  }
  if (!empty($monthFilter)) {
    $sql .= " AND `MONTH` = :month";
  }
  if (!empty($yearFilter)) {
    $sql .= " AND `YEAR` = :year";
  }
  if (!empty($stageFilter)) {
    $sql .= " AND `CROP STAGE` = :stage";
  }
  if (!empty($partsFilter)) {
    $sql .= " AND `PARTS-AFFECTED` = :parts";
  }
  if (!empty($seasonFilter)) {
    $sql .= " AND `SEASON` = :season";
  }
  if (!empty($stateFilter)) {
    $sql .= " AND `STATE` = :state";
  }
  if (!empty($pordFilter)) {
    $sql .= " AND `PORD` = :pord";
  }

  // Prepare the statement and bind filter values
  $stmt = $conn->prepare($sql);
  if (!empty($userFilter)) {
    $stmt->bindValue(':user', $userFilter);
  }
  if (!empty($cropFilter)) {
    $stmt->bindValue(':crop', $cropFilter);
  }
  if (!empty($monthFilter)) {
    $stmt->bindValue(':month', $monthFilter);
  }
  if (!empty($yearFilter)) {
    $stmt->bindValue(':year', $yearFilter);
  }
  if (!empty($stageFilter)) {
    $stmt->bindValue(':stage', $stageFilter);
  }
  if (!empty($partsFilter)) {
    $stmt->bindvalue(':parts', $partsFilter);
  }
  if (!empty($seasonFilter)) {
    $stmt->bindvalue(':season', $seasonFilter);
  }
  if (!empty($stateFilter)) {
    $stmt->bindValue(':state', $stateFilter);
  }
  if (!empty($pordFilter)) {
    $stmt->bindValue(':pord', $pordFilter);
  }

  $stmt->execute();

  $data = $stmt->fetchAll();
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Approver</title>
  <link rel="stylesheet" href="../admin/AdminDisplay.css">
  <meta charset="UTF-8">
</head>

<body>

  <div class='heading'>
    <div></div>
    <center>
      <h1 class="h">Approver</h1>
    </center>
    <button onclick="window.location.href = '../logout.php';">Logout</button>
  </div>

  <div class="side-panel">
    <div class="filters">
      <table>
        <tr>
          <th colspan="9">
            <h2>Filters</h2>
          </th>
        </tr>
        <tr>
          <td>
            <div>
              <label for="user-filter">USER</label>
            </div>
          </td>
          <td>
            <div>
              <label for="crop-filter">CROP</label>
            </div>
          </td>
          <td>
            <div>
              <label for="month-filter">MONTH</label>
            </div>
          </td>
          <td>
            <div>
              <label for="year-filter">YEAR</label>
            </div>
          </td>
          <td>
            <div>
              <label for="stage-filter">CROP STAGE</label>
            </div>
          </td>
          <td>
            <div>
              <label for="parts-filter">PARTS AFFECTED</label>
            </div>
          </td>
          <td>
            <div>
              <label for="season-filter">SEASON</label>
            </div>
          </td>
          <td>
            <div>
              <label for="state-filter">STATE</label>
            </div>
          </td>
          <td>
            <div>
              <label for="pord-filter">HEALTH STATE</label>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <div>
              <select id="user-filter" name="user">
                <option value="">All</option>
                <?php
                $userQuery = $conn->query("SELECT DISTINCT `User` FROM `tempdb`");
                $userData = $userQuery->fetchAll();
                foreach ($userData as $user) {
                  $selected = ($_GET['user'] ?? '') == $user['User'] ? 'selected' : '';
                  echo "<option value=\"{$user['User']}\" $selected>{$user['User']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="crop-filter" name="crop">
                <option value=<?php echo $b; ?>><?php echo $b; ?></option>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="month-filter" name="month">
                <option value="">All</option>
                <?php
                $monthQuery = $conn->query("SELECT DISTINCT `MONTH` FROM `tempdb`");
                $monthData = $monthQuery->fetchAll();
                foreach ($monthData as $month) {
                  $selected = ($_GET['month'] ?? '') == $month['MONTH'] ? 'selected' : '';
                  echo "<option value=\"{$month['MONTH']}\" $selected>{$month['MONTH']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="year-filter" name="year">
                <option value="">All</option>
                <?php
                $yearQuery = $conn->query("SELECT DISTINCT `YEAR` FROM `tempdb`");
                $yearData = $yearQuery->fetchAll();
                foreach ($yearData as $year) {
                  $selected = ($_GET['year'] ?? '') == $year['YEAR'] ? 'selected' : '';
                  echo "<option value=\"{$year['YEAR']}\" $selected>{$year['YEAR']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="stage-filter" name="stage">
                <option value="">All</option>
                <?php
                $stageQuery = $conn->query("SELECT DISTINCT `CROP STAGE` FROM `tempdb`");
                $stageData = $stageQuery->fetchAll();
                foreach ($stageData as $stage) {
                  $selected = ($_GET['stage'] ?? '') == $stage['CROP STAGE'] ? 'selected' : '';
                  echo "<option value=\"{$stage['CROP STAGE']}\" $selected>{$stage['CROP STAGE']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="parts-filter" name="parts">
                <option value="">All</option>
                <?php
                $partsQuery = $conn->query("SELECT DISTINCT `PARTS-AFFECTED` FROM `tempdb`");
                $partsData = $partsQuery->fetchAll();
                foreach ($partsData as $parts) {
                  $selected = ($_GET['parts'] ?? '') == $parts['PARTS-AFFECTED'] ? 'selected' : '';
                  echo "<option value=\"{$parts['PARTS-AFFECTED']}\" $selected>{$parts['PARTS-AFFECTED']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="season-filter" name="season">
                <option value="">All</option>
                <?php
                $seasonQuery = $conn->query("SELECT DISTINCT `SEASON` FROM `tempdb`");
                $seasonData = $seasonQuery->fetchAll();
                foreach ($seasonData as $season) {
                  $selected = ($_GET['season'] ?? '') == $season['SEASON'] ? 'selected' : '';
                  echo "<option value=\"{$season['SEASON']}\" $selected>{$season['SEASON']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="state-filter" name="state">
                <option value="">All</option>
                <?php
                $stateQuery = $conn->query("SELECT DISTINCT `STATE` FROM `tempdb`");
                $stateData = $stateQuery->fetchAll();
                foreach ($stateData as $state) {
                  $selected = ($_GET['state'] ?? '') == $state['STATE'] ? 'selected' : '';
                  echo "<option value=\"{$state['STATE']}\" $selected>{$state['STATE']}</option>";
                }
                ?>
              </select>
            </div>
          </td>
          <td>
            <div>
              <select id="pord-filter" name="pord">
                <option value=<?php echo $pe; ?>><?php echo $pe; ?></option>
              </select>
            </div>
          </td>
        </tr>
        <div class="filter-buttons">
          <tr>
            <td colspan="4">
            </td>
            <td style="text-align: right;">
              <button onclick="applyFilters()" class="b1">Apply Filters</button>
            </td>
            <td colspan="4" style="text-align: left;">
              <button onclick="resetFilters()" class="b2">Reset Filters</button>
            </td>

          </tr>
      </table>
    </div>
  </div>
  <div class="content">
    <table>
      <tr>
        <th>
          <h2 class="z">IMAGE Name</h2>
        </th>
        <th>
          <h2 class="z">CROP</h2>
        </th>
        <th>
          <h2 class="z">MONTH</h2>
        </th>
        <th>
          <h2 class="z">YEAR</h2>
        </th>
        <th>
          <h2 class="z">CROP STAGE</h2>
        </th>
        <th>
          <h2 class="z">STATE</h2>
        </th>
        <th>
          <h2 class="z">DEVICE</h2>
        </th>
        <th>
          <h2 class="z">PEST STAGE</h2>
        </th>
        <th rowspan='2'>
          <h2 class="z">IMAGE</h2>
        </th>
      </tr>
      <tr>
        <th>
          <h2 class="z">SEASON</h2>
        </th>
        <th>
          <h2 class="z">PARTS AFFECTED</h2>
        </th>
        <th>
          <h2 class="z">HEALTH STATE</h2>
        </th>
        <th>
          <h2 class="z">AREA</h2>
        </th>
        <th>
          <h2 class="z">BACKGROUND</h2>
        </th>
        <th>
          <h2 class="z">SCI NAME</h2>
        </th>
        <th>
          <h2 class="z">IMAGE CONTENTS</h2>
        </th>
        <th>
          <h2 class="z">Actions</h2>
        </th>
      </tr>
      <?php foreach ($data as $row): ?>
        <?php
        $_SESSION['ID'] = $row['IName'];
        $id = $_SESSION['ID'];
        ?>
        <tr style="margin-top: 1%;">
          <td>
            <center>
              <?= $row['IName'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['CROP'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['MONTH'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['YEAR'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['CROP STAGE'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['STATE'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['DEVICE/SHOT'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['STAGE'] ?>
            </center>
          </td>
          <td rowspan="2">
            <img src="data:image/jpeg;base64,<?= base64_encode($row['IMAGE']) ?>" onclick="openFullscreenImage(this)"
              style="width: 200px; height: 200px; cursor: pointer;">
          </td>
        </tr>
        <tr>
          <td>
            <center>
              <?= $row['SEASON'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['PARTS-AFFECTED'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['PORD'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['AREA'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['BACKGROUND'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['PORDNAME'] ?>
            </center>
          </td>
          <td>
            <center>
              <?= $row['IMGCONTAINS'] ?>
            </center>
          </td>
          <td>
            <center>
              <form action='transferdata.php' method='POST' style='text-align:center;'>
                <input type=hidden name='id' value="<?= $id ?>">
                <input class='butt1' type='submit' name='approve' onclick='transferdata.php'
                  value='Approve &#x2714;'></input>
              </form>

              <form action="reject.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this?')">
                <input type=hidden name='id' value="<?= $id ?>">
                <input class='butt2' type='submit' value='Reject &#x2716;'></input>
              </form>

              <form action='edit.php' method='POST' style='text-align:center;'>
                <input type=hidden name='id' value="<?= $id ?>">
                <input class='butt3' type='submit' name='edit' onclick='edit.php' value='Edit &#x2712;'></input>
              </form>
            </center>
          </td>
        </tr>
        <tr>
          <td colspan="9">
            <center>
              <h2>Uploaded By:
                <?= $row['User']; ?>
              </h2>
            </center>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <script>
    function openFullscreenImage(img) {
      var fullscreen = document.createElement('div');
      fullscreen.style.position = 'fixed';
      fullscreen.style.top = 0;
      fullscreen.style.left = 0;
      fullscreen.style.width = '100%';
      fullscreen.style.height = '100%';
      fullscreen.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
      fullscreen.style.display = 'flex';
      fullscreen.style.justifyContent = 'center';
      fullscreen.style.alignItems = 'center';
      fullscreen.style.zIndex = 9999;

      var imgElement = document.createElement('img');
      imgElement.src = img.src;
      imgElement.style.maxWidth = '90%';
      imgElement.style.maxHeight = '90%';

      fullscreen.appendChild(imgElement);
      fullscreen.onclick = function () {
        fullscreen.parentNode.removeChild(fullscreen);
      };

      document.body.appendChild(fullscreen);

      fullscreen.addEventListener('click', function () {
        document.body.removeChild(fullscreen);
      });
    }
    function applyFilters() {
      var userFilter = document.getElementById('user-filter').value;
      var cropFilter = document.getElementById('crop-filter').value;
      var monthFilter = document.getElementById('month-filter').value;
      var yearFilter = document.getElementById('year-filter').value;
      var stageFilter = document.getElementById('stage-filter').value;
      var partsFilter = document.getElementById('parts-filter').value;
      var seasonFilter = document.getElementById('season-filter').value;
      var stateFilter = document.getElementById('state-filter').value;
      var pordFilter = document.getElementById('pord-filter').value;
      var url = 'display.php';

      if (userFilter || cropFilter || monthFilter || yearFilter || stageFilter || partsFilter || seasonFilter || stateFilter || pordFilter) {
        url += '?';
        if (userFilter) {
          url += 'user=' + userFilter + '&';
        }
        if (cropFilter) {
          url += 'crop=' + cropFilter + '&';
        }
        if (monthFilter) {
          url += 'month=' + monthFilter + ' & ';
        }
        if (yearFilter) {
          url += 'year=' + yearFilter + '&';  // Include the year filter
        }
        if (stageFilter) {
          url += 'stage=' + stageFilter + '&';
        }
        if (partsFilter) {
          url += 'parts=' + partsFilter + '&';
        }
        if (seasonFilter) {
          url += 'season=' + seasonFilter + '&';
        }
        if (stateFilter) {
          url += 'state=' + stateFilter + ' & ';
        }
        if (pordFilter) {
          url += 'pord=' + pordFilter + '&';
        }
        // Remove the trailing '&' from the URL
        url = url.slice(0, -1);
      }
      // Redirect to the filtered URL
        window.location.href = url;
      }


    function resetFilters() {
      window.location.href = 'display.php';
    }

  </script>
<!-- </body>
<script>
    applyFilters();
</script> -->

</html>