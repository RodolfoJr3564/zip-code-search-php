<!DOCTYPE html>
<html>

<head>
    <title>Consulta de Endereço</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <section id="searchSection">
        <h2>Digite um CEP</h2>
        <form id="cepForm" onsubmit="return validCep()">
            <input type="text" id="cepInput" placeholder="Insira o CEP" pattern="\d{5}-?\d{3}" title="Digite um CEP válido. Exemplo: 12345-678 ou 12345678" required />
            <select id="formatSelector">
                <?php foreach ($supportedFormats as $format): ?>
                <option value="<?php echo $format; ?>">
                    <?php echo strtoupper($format); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" id="searchButton">Buscar</button>
        </form>
    </section>
    <div id="templateContainer"></div>

    <?php if (!empty($addresses)): ?>
    <section id="addressesSection">
        <h2>Endereços Armazenados</h2>
        <table id="addressesTable">
            <thead>
                <tr>
                <?php foreach (array_keys(current($addresses)) as $field): ?>
                    <th>
                        <a href="<?php echo htmlspecialchars($queryState[$field]['link']); ?>">
                            <?php echo ucfirst(["zip" => "cep", "street" => "rua", "complement" => "complemento", "district" => "bairro", "city" => "cidade", "uf" => "uf"][$field] ?? $field); ?>
                            <?php echo !empty($queryState[$field]['params']) ? ($queryState[$field]['params']['direction'] === 'asc' ? '  ↑' : '  ↓') : ''; ?>
                        </a>
                    </th>
                <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($addresses as $address): ?>
                    <tr>
                        <?php foreach ($address as $value): ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <?php endif; ?>
    <script src="script.js"></script>

</body>

</html>