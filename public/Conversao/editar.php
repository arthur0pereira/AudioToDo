<h2>Editar Conversão</h2>
<form method="post" action="index.php?c=conversao&a=atualizar">
    <input type="hidden" name="id" value="<?= $conversao['id'] ?>">
    <textarea name="texto" required><?= htmlspecialchars($conversao['texto']) ?></textarea><br><br>
    <label>Voz:</label>
    <select name="voz">
        <option value="padrão" <?= $conversao['voz_utilizada']=="padrão"?"selected":"" ?>>Padrão</option>
        <option value="masculina" <?= $conversao['voz_utilizada']=="masculina"?"selected":"" ?>>Masculina</option>
        <option value="feminina" <?= $conversao['voz_utilizada']=="feminina"?"selected":"" ?>>Feminina</option>
    </select><br><br>
    <button type="submit">Salvar Alterações</button>
</form>
