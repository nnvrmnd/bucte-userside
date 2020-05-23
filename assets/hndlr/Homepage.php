<?php
  
if(isset($_GET['homepage'])){
    require 'db.hndlr.php';

    $homepage = $_GET['homepage'];
    $statement = "SELECT * FROM content WHERE content.alias = ?";
    $query = $db->prepare($statement);
    $query->execute([$homepage]);
    $result = $query->fetch(PDO::FETCH_ASSOC);  
    
    $result['alternative_content'] = "<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc id fermentum ipsum, id sodales neque. Sed sagittis tortor turpis, ut condimentum nisl vulputate mollis. Vivamus a fringilla metus. Proin placerat dui eu sapien vulputate mollis. Ut nibh dui, pretium at feugiat eget, dapibus quis eros. Quisque nisi lorem, rhoncus nec dapibus nec, dictum ut dui. Nunc fringilla, ligula efficitur hendrerit feugiat, justo mi consequat est, et cursus elit tellus sed elit. Nam efficitur elit ante, in porttitor augue finibus vitae. Curabitur cursus est nec arcu maximus, vel pulvinar nulla malesuada. Aenean varius hendrerit lobortis. Aenean aliquet magna mattis porta convallis. Donec scelerisque luctus nibh at euismod.

    Fusce eleifend dolor vitae vehicula finibus. Vivamus sagittis erat mollis enim pulvinar eleifend. Fusce vel mi vel nunc egestas venenatis. Donec facilisis sollicitudin mattis. Proin laoreet lacus sit amet libero porta, ac sodales eros porttitor. Etiam et ex condimentum, imperdiet leo nec, tempus ipsum. Ut arcu leo, rutrum a suscipit ut, laoreet sit amet odio. Nulla sollicitudin lorem ut vehicula feugiat. Integer vehicula, magna eget scelerisque fermentum, eros ligula porta velit, sagittis condimentum nulla ex quis velit. Curabitur vehicula ultrices ante, ac vulputate ipsum tempor hendrerit. Aenean at sollicitudin dolor. Nunc rutrum enim a sapien tempus vehicula.
    
    Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras varius sapien id convallis imperdiet. Curabitur id enim ac nunc placerat imperdiet. Morbi pulvinar libero lectus, sit amet dapibus dui interdum ut. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris tincidunt malesuada eros, id ultricies quam efficitur at. Donec vitae pretium lacus.
    
    Nam sed velit dui. Quisque id sem tellus. Ut sem ligula, laoreet sit amet dui eu, fermentum fermentum velit. Quisque condimentum vestibulum sem, ut imperdiet metus vehicula sed. Nulla a risus et nibh ullamcorper ullamcorper. Curabitur quis sollicitudin augue. Ut sit amet eleifend enim, semper pretium nunc. In enim dolor, dignissim eu odio vitae, venenatis ullamcorper turpis. Proin tempor tellus et urna facilisis, id sagittis augue porta. In purus orci, iaculis at fringilla ac, porta sit amet ligula. Praesent vitae condimentum nisl, facilisis ullamcorper enim. Mauris sed est tincidunt metus pretium suscipit. Quisque accumsan nibh et egestas vestibulum. Phasellus rutrum eleifend vulputate. Donec quis cursus tellus, ut sodales quam. Maecenas ultricies elit sem, et rhoncus lorem euismod a. </p>";
    
    $result['alternative_title'] = "Bicol University Center For Teaching Excellence";

    $statementi = "SELECT * FROM content_images where c_id = ? and content_images.image LIKE 'image-%'";
    $queryi = $db->prepare($statementi);
    $queryi->execute([$result['c_id']]);
    $resulti = $queryi->fetchall(PDO::FETCH_ASSOC);  
    $array_result = array(); 
    $array_result['contents'] = $result;
    $array_result['images'] = $resulti;
    echo json_encode($array_result);
}

if(isset($_GET['images'])){
    require 'db.hndlr.php';
    $statementi = "SELECT * FROM events ORDER BY end_date ASC LIMIT 10";
    $queryi = $db->prepare($statementi);
    $queryi->execute();
    $resulti = $queryi->fetchall(PDO::FETCH_ASSOC);  
    echo json_encode($resulti);
    //var_dump($resulti);
}
