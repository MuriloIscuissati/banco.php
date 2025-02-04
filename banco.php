<?php 

$clientes = [];
$contas   = [];


function cadastrarCliente(&$clientes, string $nome, string $cpf, string $telefone): void {
    
    //global $clientes; //Alternativa para acesso de variáveis fora do escopo da função

    $cliente = [
        "nome" => $nome,
        "cpf"  => $cpf, //11 digitos
        "telefone" => $telefone //10 digitos
    ];
    
    $clientes[] = $cliente;
    
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
        print("Não é possível depositar valores negativos");
        return;
    }
    foreach ($contas as &$conta){
        
        if($conta['$numeroConta' == $numeroConta]){
            $conta['saldo'] += $quantia;

            print "Depósito de R$$quantia realizado na conta $numeroConta.";
            
            break;
        }

        else{

        }
    }
}

function sacar(&$contas, $numeroConta, $quantia){

    foreach ($contas as &$conta){

        if($conta['numeroConta'] == $numeroConta){
            
            if($quantia > $conta['saldo']){
                print("Sua conta não tem saldo suficiente para realizar a operação.");
                break;               
            }

            $conta['saldo'] -= $quantia;

            print "Saque de R$$quantia realizado na conta $numeroConta";

            break;
        }

        else{

            print "Conta $numeroConta não encontrada";
        }
    }
}

function consultarSaldo(&$contas, $numeroConta){

    foreach ($contas as $conta){
        if  ($conta['numeroConta'] == $numeroConta){
            print "Saldo da conta {$numeroConta}: R$$conta";
        }
    }
}
cadastrarCliente($clientes, "Jefferson", "06800044455", "(45)99999999999");
$numeroConta = cadastrarConta($contas, "06800044455");

print_r($contas);
