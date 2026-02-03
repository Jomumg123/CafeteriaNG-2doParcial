<?php 
// El encabezado ya maneja la sesión y las alertas
include '../app/views/includes/header.php'; 
?>

<main class="flex-admin-container" style="padding: 40px 5%; min-height: 80vh;">
    <div style="background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 1100px; margin: 0 auto;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #F5F5DC; padding-bottom: 15px;">
            <h2 style="color: #6F4E37; font-family: 'Playfair Display', serif; margin: 0;">📦 Gestión y Facturación</h2>
            <span style="background: #C39977; color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: bold;">
                Panel Administrativo
            </span>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-family: 'Montserrat', sans-serif;">
                <thead>
                    <tr style="background-color: #F5F5DC; color: #6F4E37;">
                        <th style="padding: 12px; text-align: left; border-radius: 10px 0 0 0;">ID</th>
                        <th style="padding: 12px; text-align: left;">Cliente</th>
                        <th style="padding: 12px; text-align: left;">Producto</th>
                        <th style="padding: 12px; text-align: center;">Cant.</th>
                        <th style="padding: 12px; text-align: left;">Notas Especiales</th>
                        <th style="padding: 12px; text-align: right;">Total</th>
                        <th style="padding: 12px; text-align: center;">Estado</th>
                        <th style="padding: 12px; text-align: right; border-radius: 0 10px 0 0;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $gran_total = 0;
                    while ($p = $stmt->fetch(PDO::FETCH_ASSOC)): 
                        $subtotal = $p['precio'] * $p['cantidad'];
                        $gran_total += $subtotal;
                    ?>
                        <tr style="border-bottom: 1px solid #eee; transition: 0.3s;" onmouseover="this.style.backgroundColor='#fffcf5'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 12px; font-weight: bold; color: #A0522D;">#<?php echo $p['id']; ?></td>
                            <td style="padding: 12px; color: #333; font-size: 0.9rem;"><?php echo htmlspecialchars($p['cliente']); ?></td>
                            <td style="padding: 12px; color: #333; font-weight: 500; font-size: 0.9rem;">
                                ☕ <?php echo htmlspecialchars($p['producto']); ?>
                            </td>
                            <td style="padding: 12px; text-align: center; font-weight: bold;">x<?php echo $p['cantidad']; ?></td>
                            <td style="padding: 12px; color: #666; font-size: 0.8rem; font-style: italic; max-width: 200px;">
                                <?php echo !empty($p['notas']) ? htmlspecialchars($p['notas']) : '<span style="color:#ccc;">Sin notas</span>'; ?>
                            </td>
                            <td style="padding: 12px; text-align: right; font-weight: bold; color: #6F4E37;">
                                $<?php echo number_format($subtotal, 2); ?>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <span style="padding: 4px 10px; border-radius: 15px; font-size: 0.7rem; font-weight: bold; 
                                    <?php echo ($p['estado'] == 'Pendiente') ? 'background: #FFE5D9; color: #D9480F;' : 'background: #D3F9D8; color: #2B8A3E;'; ?>">
                                    <?php echo $p['estado']; ?>
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: right;">
                                <?php if ($p['estado'] == 'Pendiente'): ?>
                                    <a href="index.php?action=entregar_pedido&id=<?php echo $p['id']; ?>" 
                                       style="background-color: #6F4E37; font-size: 0.7rem; padding: 5px 10px; text-decoration: none; border-radius: 5px; color: white; display: inline-block;">
                                       Entregar
                                    </a>
                                <?php else: ?>
                                    <span style="color: #2B8A3E; font-size: 1.2rem;">✓</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #fcfcfc;">
                        <td colspan="5" style="padding: 15px; text-align: right; font-weight: bold; color: #6F4E37;">Ventas Totales del Periodo:</td>
                        <td style="padding: 15px; text-align: right; font-weight: 800; color: #6F4E37; font-size: 1.1rem; border-top: 2px solid #C39977;">
                            $<?php echo number_format($gran_total, 2); ?>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <?php if ($stmt->rowCount() == 0): ?>
            <div style="padding: 30px; text-align: center; color: #999; font-style: italic;">
                No hay pedidos registrados por el momento.
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include '../app/views/includes/footer.php'; ?>