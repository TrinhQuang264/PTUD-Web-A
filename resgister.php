<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng Ký</title>
  <link rel="stylesheet" href="register.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
</head>

<style>
  .header {
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    background-color: antiquewhite;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .header .logo {
    margin-left: 20px;
    font-size: 30px;
    font-weight: 900;
    letter-spacing: 1px;
  }

  .container {
    min-height: 70vh;
  }

  .nou {
    position: absolute;
    top: 480px;
    font-size: 10px;
    align-content: center;
    left: 620px;
    color: red;
  }
</style>

<body>
  <!-- phần header -->
  <header class="header">
    <div class="logo"><a href="index.php">COURSE</a></div>
  </header>
  <!-- form đăng ký -->
  <div class="container">
    <form action="" method="POST" class="login-box">
      <h2>Đăng Ký</h2>
      <p>Họ và Họ Đệm:</p>
      <input
        type="text"
        name="last_name"
        placeholder="Đăng Ký Họ và Họ Đệm " id='last_name' required />
      <p>Tên:</p>
      <input type="text" name="first_name" placeholder="Đăng Ký Tên " id='first_name' required /><br />
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



  if (isset($_POST["last_name"]) != "" && isset($_POST["first_name"]) != "" && isset($_POST["email"]) != "" && isset($_POST["password"]) != "") {
    require 'connect.php';
    $last_name = $_POST["last_name"];
    $first_name = $_POST["first_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "INSERT INTO account(email,password,first_name,last_name,role_id)
            VALUE ('$email','$password','$first_name','$last_name','user')";
    //check xem đã nhập thông tin và ok hay chưa
    if ($conn->query($sql) === True) {
      echo "<script>
              alert('Bạn đã đăng ký thành công');
            </script>";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }

  ?>
</body>

</html>