<?php


namespace Cantera\Transito\Contrato\Dominio;


use Cantera\Transito\Shared\Dominio\Collection;

class ContratoTickets extends Collection
{

    protected function type(): string
    {
        return Ticket::class;
    }

    public function add(Ticket $ticket)
    {
        return new self(array_merge($this->items(), [$ticket]));
    }

    public function search(callable $fn): ?Detalle
    {
        foreach ($this->items() as $item) {
            if ($fn($item))
                return $item;
        }
        return null;
    }
}
