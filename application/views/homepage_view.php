<div class="page-header">
<h1>Munmer Difflin</h1>
<h1><small>Peoples persons portions people</small></h2>
</div>

<div style="width:80%; margin:auto; margin-top:1em">
<table class="table" style="width:500px">
  <thead>
    <tr>
      <th>Recipe Name</th>
      <th>Amount Created</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($this->data['mapOfRecipeCounts'] as $name => $amount): ?>
  <tr>
     <td><?php echo $name ?></td>
     <td><?php echo $amount ?></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>

<div style="width:80%; margin:auto; margin-top:1em">
<table class="table" style="width:500px">
  <thead>
    <tr>
      <th>Recipe Name</th>
      <th>Total Value Sold</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($this->data['mapOfRecipesSold'] as $first_name => $last_name): ?>
  <tr>
     <td><?php echo $first_name ?></td>
     <td><?php echo $last_name ?></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>