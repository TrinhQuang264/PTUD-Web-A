<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng Ký</title>
  <link rel="stylesheet" href="./css/register.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
</head>



<body>
  <!-- phần header -->
  <header class="header">
    <div class="logo"><a href="index.php">COURSE</a></div>
  </header>
  <!-- form đăng ký -->
  <div class="container">
    <form action="" method="POST" class="login-box">
      <h2>Đăng Ký</h2>
      <p>Họ và Tên</p>
      <input type="text" name="fullname" placeholder="Đăng Ký Tên " id='fullname' required /><br />
      <p>Email:</p>
      <input type="email" name="email" placeholder="Đăng Ký Email " id='email' required /><br />
      <p>Mật khẩu:</p>
      <input
        type="password"
        name="password"
        placeholder="Đăng Ký Mật Khẩu " id='password' required /><br />
      <input type="submit" value="Đăng Ký" class="submit-button" />

      <p class="question-login">
        Bạn đã có tài khoản? <a href="login.php">Đăng Nhập</a>
      </p>
    </form>
  </div>
  <?php



  if (isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    require 'connect.php';
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO account(email,password,fullname,role_id)
            VALUE ('$email','$password','$fullname','user')";
    //check xem đã nhập thông tin và ok hay chưa
    if ($conn->query($sql) === True) {
      echo "<script>
              alert('Bạn đã đăng ký thành công');
            </script>";
    } else {
      "<script>
              alert('Error: ' . $sql . '< br > ' . $conn->error);
      </script>";
    }
    $conn->close();
  }

  ?>
</body>

</html>