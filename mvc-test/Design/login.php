<?php include("header.php"); ?>

<main>
    <div>

    <!--<h2 class="category-title">ЛОГИН / РЕГИСТРАЦИЯ</h2>-->
    <div id="forum">
        <form action="post" class="login-registration">
            <h2 class="form-title">ВХОД</h2>
            <p>Ако вече имате регистрация влезте като попълните данните си:</p>
            <input type="text" name="username" placeholder="Потребителско име"><br />
            <input type="password" name="password" placeholder="******"><br />
            <input type="submit" name="submit" value="ВХОД">
        </form>
        <form action="post" class="login-registration">
            <h2 class="form-title">РЕГИСТРАЦИЯ</h2>
            <p>Ако все още нямате акаунт можете да се регистрирате от тук:</p>
            <input type="text" name="username" placeholder="Потребителско име"><br />
            <input type="password" name="password" placeholder="******"><br />
            <input type="email" name="password" placeholder="Email"><br />
            <div class="file-holder">
                <input type="file" name="avatar">
                <input type="text" name="avatar" placeholder="Click here to choose avatar">
            </div>
            <textarea placeholder="Описание за вас"></textarea><br>
            <input type="submit" name="submit" value="РЕГИСТРАЦИЯ">
        </form>
    </div>
    </div>
</main>

<?php include("footer.php"); ?>
