<div class="container mt-5 mb-3">
    <div class="row pt-3">
        <div class="col-md-12 p-3 mt-2 mb-4 border-bottom">
            <h1>Envie seu currículo</h1>
        </div>
    </div>

    <div class="my-3">
        <?php showAlerts(); ?>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="<?= url($action) ?>" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name" class="required">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="client">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="client">Telefone:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="role">Cargo desejado</label>
                        <input type="text" class="form-control" id="role" name="role" required />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="education">Seu nível de escolaridade</label>
                        <select class="custom-select" id="education" name="education" required>
                            <option value="" selected>Selecione uma opção</option>
                            <option value="1">Educação infantil</option>
                            <option value="2">Ensino fundamental</option>
                            <option value="3">Ensino médio</option>
                            <option value="4">Graduação</option>
                            <option value="5">Pós-graduação</option>
                            <option value="6">Mestrado</option>
                            <option value="7">Doutorado</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="observation" class="required">Observações</label>
                    <textarea class="form-control" id="observation" name="observation" rows="3" /></textarea>
                </div>

                <div class="form-group mt-5">
                    <input type="file" name="resumeFile" id="resumeFile" accept=".doc,.docx,.pdf" required />
                </div>

                <div class="mt-5 mb-5">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>