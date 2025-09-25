<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Students Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      color: #fff;
    }

    section {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      min-height: 100vh;
      overflow: hidden;
      padding: 20px;
      background: linear-gradient(135deg, #667eea, #764ba2);
    }

    section .bg, section .trees {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      pointer-events: none;
    }

    section .trees {
      z-index: 1;
    }

    .glass-container {
      position: relative;
      margin: 40px auto;
      padding: 40px;
      width: 100%;
      max-width: 1000px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.1);
      color: #fff;
      z-index: 2;
    }

    .glass-container h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 2.2em;
      font-weight: 700;
      text-shadow: 0 3px 8px rgba(0,0,0,0.3);
      color: #8f2c24;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .logout-btn {
      padding: 10px 18px;
      background: rgba(220, 53, 69, 0.9);
      border: none;
      border-radius: 8px;
      font-weight: 600;
      color: #fff;
      cursor: pointer;
      transition: all 0.3s ease;
      backdrop-filter: blur(5px);
    }

    .logout-btn:hover {
      background: #b02a37;
      transform: translateY(-2px);
    }

    .search-form {
      display: flex;
      align-items: center;
      gap: 10px;
      background: rgba(255, 255, 255, 0.1);
      padding: 8px 14px;
      border-radius: 12px;
      backdrop-filter: blur(6px);
    }

    .search-form input {
      border-radius: 6px;
      padding: 10px;
      border: none;
      font-size: 14px;
    }

    .search-form input:focus {
      outline: none;
      box-shadow: 0 0 8px rgba(102, 126, 234, 0.7);
    }

    .search-form button {
      padding: 10px 18px;
      font-size: 14px;
      font-weight: 600;
      border-radius: 6px;
      border: none;
      background: linear-gradient(to right, #373bff, #282ca7);
      color: #fff;
      transition: 0.3s ease;
    }

    .search-form button:hover {
      background: linear-gradient(to right, #2529b0, #1f2380);
      transform: translateY(-2px);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(8px);
      margin-bottom: 20px;
    }

    th, td {
      padding: 16px;
      text-align: center;
      font-size: 15px;
    }

    th {
      background: rgba(102, 126, 234, 0.85);
      color: #fff;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }

    td {
      color: #8f2c24;
      text-shadow: 0 2px 5px rgba(0,0,0,0.4);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    tr:last-child td {
      border-bottom: none;
    }

    tr:hover {
      background: rgba(255, 255, 255, 0.1);
      transition: 0.3s ease;
    }

    a {
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s ease;
      margin: 0 4px;
      display: inline-block;
    }

    a[href*="update"] {
      background: #17a2b8;
      color: #fff;
    }

    a[href*="update"]:hover {
      background: #138496;
      transform: translateY(-2px);
    }

    a[href*="delete"] {
      background: #dc3545;
      color: #fff;
    }

    a[href*="delete"]:hover {
      background: #b02a37;
      transform: translateY(-2px);
    }

    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .btn-create {
      display: inline-block;
      padding: 12px 20px;
      border-radius: 10px;
      background: linear-gradient(to right, #28a745, #20c997);
      color: #fff;
      font-weight: bold;
      font-size: 15px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-create:hover {
      background: linear-gradient(to right, #218838, #198754);
      transform: translateY(-2px);
    }

    @media (max-width: 768px) {
      .search-form input {
        width: 160px;
      }
      table {
        width: 100%;
      }
      th, td {
        padding: 10px;
      }
      .btn-create {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <section>
    <img src="/public/images/bg.jpg" class="bg">
    <img src="/public/images/trees.png" class="trees">

    <div class="glass-container">
      <h1>Users Dashboard</h1>

      <div class="top-bar">
        <a href="<?=site_url('auth/logout'); ?>"><button class="logout-btn">Logout</button></a>
        <form action="<?=site_url('users');?>" method="get" class="search-form">
          <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
          <input name="q" type="text" placeholder="Search" value="<?=html_escape($q);?>">
          <button type="submit">Search</button>  
        </form>
      </div>

      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        <?php foreach (html_escape($user) as $users): ?>
        <tr>
          <td><?=$users['id']; ?></td>
          <td><?=$users['username']; ?></td>
          <td><?=$users['email']; ?></td>
          <td>
            <a href="<?=site_url('/users/update/'.$users['id']);?>">Update</a>
            <a href="<?=site_url('/users/delete/'.$users['id']);?>">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>

      <?php echo $page; ?>

      <div class="button-container">
        <a href="<?=site_url('users/create'); ?>" class="btn-create">+ Create New User</a>
      </div>
    </div>
  </section>
</body>
</html>
