<?php 

$clientes = [];
$contas   = [];


function cadastrarCliente(&$clientes, string $nome, string $cpf, string $telefone): bool {
    
    //global $clientes; //Alternativa para acesso de variáveis fora do escopo da função

    if(strlen($telefone) != 10){

        print("Telefone inválido. Seu número de telefone deve ter 10 digitos, com DDD incluso.\n");
        return false;
    }

    if(!validar_cpf($cpf)){

        print "CPF inválido.\n ";
        return false;
    }

    $cliente = [
        "nome" => $nome,
        "cpf"  => $cpf, //11 digitos
        "telefone" => $telefone //10 digitos
    ];
    
    $clientes[] = $cliente;
    return True;
    
}

function cadastrarConta(&$contas, $cpfCliente): string {
    
    $conta = [
        "numeroConta" => uniqid(),
        "cpfCliente" => $cpfCliente,
        "saldo" => 0
    ];
    
    $contas[] = $conta;

    return $conta['numeroConta'];
}

function depositar(&$contas, $numeroConta, $quantia){

    if($quantia < 0){
        print("Não é possível depositar valores negativos.\n");
        return;
    }
    
    foreach ($contas as &$conta){
        
        if($conta['numeroConta'] == $numeroConta){
            $conta['saldo'] += $quantia;

            print "Depósito de R$$quantia realizado na conta $numeroConta.\n";
            
            return;
        }
    }

    print "Conta não encontrada.\n";
}

function sacar(&$contas, $numeroConta, $quantia){

    foreach ($contas as &$conta){

        if($conta['numeroConta'] == $numeroConta){
            
            if($quantia > $conta['saldo']){
                print("Sua conta não tem saldo suficiente para realizar a operação.\n");
                break;               
            }

            if($quantia < 0){

                print "Não é possível sacar valores negativos.\n";
                break;
            }

            $conta['saldo'] -= $quantia;

            print "Saque de R$$quantia realizado na conta $numeroConta.\n";

            return;
        }
        
    }
   
        print "Conta $numeroConta não encontrada.\n";
        
}

function consultarSaldo(&$contas, $numeroConta){

    foreach ($contas as $conta){
        if  ($conta['numeroConta'] == $numeroConta){
            print "Saldo da conta {$numeroConta}: R$" . $conta['saldo'] . "\n";
            return;
        }

    }
 
    print 'Conta não encontrada.\n';
}

function validar_cpf(string $cpf): bool {
        
    //soma1

    if(strlen($cpf) != 11){
        return false;
    }

    $soma = 0;

    for ($i=0; $i < 9; $i++) { 
        $soma += $cpf[$i] * (10 - $i);
    }

    
    $valor = (int) ($soma / 11);
    $resto = $soma % 11;        

    if($resto < 2) {
        $digito1 = 0;
    } else if ($resto >= 2) {
        $digito1 = (11 - $resto);
    }
    
    //soma2

    $soma2 = 0;

    for ($i=0; $i < 9; $i++) { 
        $soma2 += ($cpf[$i] * (11 - $i));
    }

    $soma2 += ($digito1 * 2);

    $valor2 = (int) ($soma2 / 11);
    $resto2 = $soma2 % 11;

    // print "Valor2 $valor2 e resto2 $resto2";
    // die;

    
    //Até aqui está OK!


    if($resto2 < 2) {
        $digito2 = 0;
    } else if ($resto2 >= 2) {
        $digito2 = (11 - $resto2);
    }


    //validação


    if ($digito1 != $cpf[9]) {
        $cpf = false;
    } else {
        if ($digito2 == $cpf[10]) {
            return true;
        } else {
            return false;
        } 
    }

    return false;
}

do{
    
    print "Bem-vindo ao banco Confiança Zero, onde você pode ter certeza que seus dados serão roubados!\n";
    sleep(2);

    print "O que gostaria de fazer?\n";
    
    print "1)Cadastrar \n2)Criar conta (necessário ter um cadastro) \n3)Depositar \n4)Sacar \n5)Consultar saldo \n6)Encerrar operações: ";
    $resposta = readline("");

    while($resposta < 1 or $resposta > 6){
        
        $resposta = readline("Resposta inválida. ");
    }

    switch ($resposta) {
       
        case '1':
            
            $nome = readline('Informe seu nome: ');
            $cpf = readline((string)'Informe seu CPF: ');                           //cadastrar cliente
            $telefone = readline('Informe seu telefone: ');

            if(cadastrarCliente($clientes, $nome, $cpf, $telefone)){
               
                print 'Cadastro realizado!\n';
            }
            else{

                print "Não foi possível realizar o cadastro.\n ";
            }

            break;
        
        case '2':
            
            $nome = readline('Informe o nome que você cadastrou: ');

            foreach($clientes as $cliente){
                
                if($cliente['nome'] == $nome){

                    $numeroConta = cadastrarConta($contas, $cliente['cpf']);        //cadastrar conta bancária
                    
                    print "Conta cadastrada! O número da sua conta é $numeroConta. Sugiro que anote-o agora!\n";
                    break;
                }
                else{

                    print  'Nome não cadastrado.';
                }
            }
            break;
            
            case '3':

                $numeroConta = readline("Informe o número da sua conta: ");
                $quantia = readline("Informe quanto deseja depositar: ");           //depositar

                depositar($contas, $numeroConta, $quantia);

                break;
            
            case '4':
                
                $numeroConta = readline("Informe o número da sua conta: ");
                $quantia = readline("Informe quanto deseja sacar: ");               //sacar

                sacar($contas, $numeroConta, $quantia);

                break;

            case '5':

                $numeroConta = readline("Informe o número da sua conta: ");        //constultar saldo

                consultarSaldo($contas, $numeroConta);
                break;
            
            sleep(2);
     
}
}while($resposta != 6);

print "\nObrigado pela desconfiança!";
