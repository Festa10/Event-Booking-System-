<?php 

include __DIR__ . "/../includes/header.php"; 


function myErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("myErrorHandler");
?>

<style>
    .error-wrapper {
        background: linear-gradient(135deg, #f8d7da 0%, #f5f7fa 100%); 
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        padding: 20px;
    }
    .error-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 500px;
        border-left: 8px solid #dc3545; 
    }
    .error-icon {
        font-size: 50px;
        color: #dc3545;
        margin-bottom: 20px;
    }
</style>

<div class="error-wrapper">
    <div class="error-card">
        <div class="error-icon">⚠️</div>
        <h2>Njoftim mbi Sistemin</h2>
        
        <div style="background: #fff5f5; padding: 20px; border-radius: 10px; margin: 20px 0; color: #721c24; text-align: left; font-size: 14px; border: 1px solid #f5c6cb;">
            <?php
            try {
                
                echo "<strong>Statusi:</strong> Sistemi po monitoron gabimet në prapavijë.<br>";
                echo "<em>Nëse ndodh një gabim në kod, ai do të shfaqet këtu automatikisht.</em>";
            } catch (Exception $e) {
                echo "<strong>Gabim i kapur:</strong> " . $e->getMessage();
            }
            ?>
        </div>

        <a href="/booking-final/index.php" style="display: inline-block; padding: 10px 20px; background: #3498db; color: white; text-decoration: none; border-radius: 5px;">Kthehu në Ballinë</a>
    </div>
</div>

<?php 
// 2. Përfshijmë Footer-in
include __DIR__ . "/../includes/footer.php"; 
?>
