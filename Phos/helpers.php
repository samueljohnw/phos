<?php

function processEmails()
{
  (new Phos\EmailHandler())->process();
}
function chain($token)
{
  return (new Phos\ContactHandler())->process($token);
}
