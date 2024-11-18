<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')): ?>
                toastr.success('<?= $this->session->flashdata('success') ?>');
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                toastr.error('<?= $this->session->flashdata('error') ?>');
            <?php endif; ?>
        });
    </script>