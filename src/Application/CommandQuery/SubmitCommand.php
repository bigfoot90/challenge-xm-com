<?php

namespace Application\CommandQuery;

class SubmitCommand extends AbstractCommand
{
    public string $company;
    public string $startDate;
    public string $endDate;
    public string $email;
}
