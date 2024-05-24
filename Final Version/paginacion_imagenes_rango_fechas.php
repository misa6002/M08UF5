<?php
        $sql_total = "SELECT COUNT(*) as total FROM imagenes i JOIN usuarios u ON u.id = i.usuario_id WHERE fecha BETWEEN '$from_datetime' AND '$to_datetime' LIMIT $pagina";
        $result_total = mysqli_query($conexion, $sql_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_resultados = $row_total['total'];
        $total_paginas = ceil($total_resultados / $pagina);
    ?>
    <nav aria-label="Página de navegación">
      <ul class="pagination">
        <?php if ($pagina_actual > 1) : ?>
            <li class="page-item"><a class="page-link"
              href="?pagina=<?php echo ($pagina_actual - 1); ?>">Anterior</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_paginas; $i++) : ?>
            <li class="page-item"><a class="page-link"
              href="?pagina=<?php echo $i; ?>" <?php if ($pagina_actual == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($pagina_actual < $total_paginas) : ?>
            <li class="page-item"><a class="page-link"
              href="?pagina=<?php echo ($pagina_actual + 1); ?>">Siguiente</a>
        <?php endif; ?>
      </ul>
    </nav>
