<?php 

$clientes = [];
$contas   = [];

//Cliente que sempre existe
$cliente = [
    "nome" => "John Doe",
    "cpf"  => "00000000000", //11 digitos
    "telefone" => "(45)9999999999" //10 digitos
];

$clientes[] = $cliente;


$conta = [
    "numeroConta" => uniqid(),
    "cpfCliente" => "00000000000",
    "saldo" => 0
];

$contas[] = $conta;


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