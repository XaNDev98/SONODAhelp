
<?php include 'layout.php'; ?>
        <!-- Main Content -->
        <div class="content container-fluid">
            <h5 class="font-weight-bold">PÁGINA INICIAL</h5><br>
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#" id="instalacoes-tab" data-toggle="tab" onclick="showTab('instalacoes')">INSTALAÇÕES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="atualizacoes-tab" data-toggle="tab" onclick="showTab('atualizacoes')">ATUALIZAÇÕES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="pacotes-tab" data-toggle="tab" onclick="showTab('pacotes')">PACOTES DE COMUNICAÇÃO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="sql-tab" data-toggle="tab" onclick="showTab('sql')">SQL</a>
                </li>
            </ul> <br>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Instalações -->
                <div id="instalacoes" class="tab-pane active">
                    <h5 class="font-weight-bold">PROGRAMAS</h5>
                    <div class="row"> 
                        <div class="col-md-4"> <!-- SECULLUM OFFLINE -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/icone-offline.png" alt="Ícone do Seculum Off-line" class="title-icon" width="45px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">SECULLUM PONTO OFF-LINE</div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="copy-button-container">
                                            <button class="copy-button-home" onclick="copyText('https://download.secullum.com.br/SecullumPontoOffline-setup.exe', this)" title="Copiar Link">
                                                <i class="fas fa-copy copy-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <h5 class="font-weight-bold">ACESSO REMOTO</h5>
                    <div class="row">
                        <div class="col-md-4"> <!-- TEWAM VIEWER -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/teamviewer.png" alt="Ícone do Team Viewer" class="title-icon" width="45px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">TEAM VIEWER</div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="copy-button-container">
                                            <button class="copy-button-home" onclick="copyText('https://download.teamviewer.com/download/TeamViewer_Setup_x64.exe', this)" title="Copiar Link">
                                                <i class="fas fa-copy copy-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <h5 class="font-weight-bold">ADICIONAIS</h5>
                    <div class="row">
                        <div class="col-md-4"> <!-- CALL BOX -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/L5.PNG" alt="Ícone do Call Box" class="title-icon" width="35px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">CALL BOX</div>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="copy-button-container">
                                            <button class="copy-button-home" onclick="copyText('http://l5networks.com.br/arquivos/lista/Softphones/CallboxWindows/L5NetworksSetup.rar', this)" title="Copiar Link">
                                                <i class="fas fa-copy copy-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                    </div>
                </div>

                <!-- Atualizações -->
                <div id="atualizacoes" class="tab-pane">
                    <div class="row">
                        <div class="col-md-6"> <!-- SECULLUM OFFLINE -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/icone-offline.png" alt="Ícone do Ponto Off-line" class="title-icon" width="45px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">SECULLUM PONTO OFF-LINE</div>
                                    </div>
                                    <div class="col-sm-2 text-end">
                                        <button class="copy-button-home" onclick="copyText('https://download.secullum.com.br/at-ponto-offline.exe', this)" title="Copiar Link">
                                            <i class="fas fa-copy copy-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pacotes de Comunicação -->
                <div id="pacotes" class="tab-pane">
                    <div class="row">
                        <div class="col-md-6"> <!-- CONTROL ID -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/Control id.png" alt="Ícone do Control ID" class="title-icon" width="100px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">CONTROL ID</div>
                                    </div>
                                    <div class="col-sm-2 text-end">
                                        <button class="copy-button-home" onclick="copyText('https://secullum.com.br/at-controlid.exe', this)" title="Copiar Link">
                                            <i class="fas fa-copy copy-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SQL -->
                <div id="sql" class="tab-pane"> 
                    <div class="row"> 
                        <div class="col-md-6"> <!-- SQL 2014 -->
                            <div class="copy-card">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-left">
                                        <img src="../adress/SQL.png" alt="sql 2014" class="title-icon" width="60px">
                                    </div>
                                    <div class="col-sm-8 text-center">
                                        <div class="copy-card-title">SQL 2014</div>
                                    </div>
                                    <div class="col-sm-2 text-end">
                                        <button class="copy-button-home" onclick="copyText('https://www.microsoft.com/pt-br/download/details.aspx?id=42299', this)" title="Copiar Link">
                                            <i class="fas fa-copy copy-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>            
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>  
</body> 
</html>
