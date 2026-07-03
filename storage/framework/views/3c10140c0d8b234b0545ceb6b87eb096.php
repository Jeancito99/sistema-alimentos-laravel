<form action="<?php echo e(route('prediccion.process')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <input type="file" name="imagen" required>
    <input type="number" step="0.1" name="temp" placeholder="Temperatura (°C)" required>
    <input type="number" step="0.1" name="hum" placeholder="Humedad (%)" required>
    <button type="submit">Predecir Vida Útil</button>
</form>

<?php if(session('success')): ?>
    <div class="alert alert-info"><?php echo e(session('success')); ?></div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\SCA_IOT\resources\views/prediccion.blade.php ENDPATH**/ ?>