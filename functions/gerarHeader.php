<?php
function gerarHeader($code, $links, $responsiveWidth, $color)
{
?>
    <style>
        header {
            background-color: <?= $color ?>;
            
            height: 40px;

        }

        #levoratech1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            /* padding: 0 30px; */
        }
        .form-control {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px 12px;
            margin-right: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .header_nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        .header_nav li {
            margin-right: 20px;
        }

        .header_nav a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: color 0.3s;
        }

        .header_nav a:hover {
            color: purple;
        }

        .menu-btn {
            display: none;
            cursor: pointer;
            margin-right: 20px;
        }

        @media screen and (max-width: <?php echo $responsiveWidth; ?>px) {
            .menu-btn {
                display: block;
            }

            .header_nav {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
                width: 100%;
                background-color: <?= $color ?>;

                margin-top: 40px;
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.2s ease-in-out;
            }

            .header_nav.active {
                transform: translateX(0);
            }

            .header_nav ul {
                flex-direction: column;
                align-items: center;
            }

            .header_nav li {
                margin: 20px 0;
            }
        }
    </style>
    <div class="logo"></div>
    <?php
    echo '<header>';
    echo '<section id="levoratech1">';
    echo '<div class="logon"></div>';
    echo '<div class="menu-btn">&#9776;</div>';
    echo '<nav class="header_nav">';
    echo '<ul>';

    foreach ($links as $nome => $url) {
        echo '<li>';
        echo '<a href="' . $url . '">' . $nome . '</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</nav>';
    echo '</section>';
    echo '</header>';


    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var menuBtn = document.querySelector('.menu-btn');
            var nav = document.querySelector('.header_nav');

            menuBtn.addEventListener('click', function() {
                nav.classList.toggle('active');
            });
        });
    </script>
<?php
}
?>