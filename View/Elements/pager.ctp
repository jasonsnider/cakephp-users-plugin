<div class="paging" style="text-align: center">
    <?php
    echo $this->Paginator->first(
            '&lsaquo; First', array('escape' => false), null, array('class' => 'disabled', 'escape' => false));
    echo $this->Paginator->prev(
            '&laquo; Previous', array('escape' => false), null, array('class' => 'disabled', 'escape' => false));
    echo ' ';
    echo $this->Paginator->numbers();
    echo ' ';
    echo $this->Paginator->next(
            'Next' . ' &raquo;', array('escape' => false), null, array('class' => 'disabled', 'escape' => false));
    echo $this->Paginator->last(
            'Last' . ' &rsaquo;', array('escape' => false), null, array('class' => 'disabled', 'escape' => false));
    ?>
</div>