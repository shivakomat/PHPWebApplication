<!start of footer !>
        <div class="grid_12 omega">
            <div id="footer">
                <div id="supportLink"><img src="images/support_button_115x89.png"></div>
                <?php 
                if(studentLogged_in() === false && teacherLogged_in() === false)
                {
                ?>
                    <div id="footerRight">
                        <div id="footerNavigation">
                            <ul class="nav">
                                <li><a href="index.php">HOME</a></li>
                                <li><a href="#">ABOUT</a></li>
                                <li><a href="#">CONTACT</a></li>               
                                <li style="border-right:0px;"><a href="#">NEWS</a></li>   
                            </ul>            
                        </div>
                        <div id="footerLogo"><img src="images/footer_logo_122x41.png"></div>
                    </div>
                <?php 
                } ?>


            </div>           
        </div>
  <div class="grid_12 omega">
    <div id="copyright"><h5>&copy; COPY RIGHT LIONSOFT. ALL RIGHTS RESERVERD.2013</h5></div>
  </div>        
<! end of footer !>
</div>
</body>
</html>