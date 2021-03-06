<?php

defined('ARTICLE_STATUS_OPEN') || define('ARTICLE_STATUS_OPEN', 1);
defined('ARTICLE_STATUS_PERMUTED') || define('ARTICLE_STATUS_PERMUTED', 2);
defined('ARTICLE_STATUS_CLOSE_ADMIN') || define('ARTICLE_STATUS_CLOSE_ADMIN', 3);
defined('ARTICLE_STATUS_CLOSE_USER') || define('ARTICLE_STATUS_CLOSE_USER', 4);
defined('ARTICLE_STATUS_PERMUTED_USER') || define('ARTICLE_STATUS_PERMUTED_USER', 5);
defined('ARTICLE_STATUS_RETIRED_USER') || define('ARTICLE_STATUS_RETIRED_USER', 6);
defined('ARTICLE_STATUS_EXPIRED') || define('ARTICLE_STATUS_EXPIRED', 7);

defined('ARTICLE_CONDITION_NEW') || define('ARTICLE_CONDITION_NEW', 1);
defined('ARTICLE_CONDITION_USED') || define('ARTICLE_CONDITION_USED', 2);
defined('ARTICLE_CONDITION_REFURBISHED') || define('ARTICLE_CONDITION_REFURBISHED', 3);

defined('QUESTION_STATUS_OPEN') || define('QUESTION_STATUS_OPEN', 1);
defined('QUESTION_STATUS_HIDE') || define('QUESTION_STATUS_HIDE', 2);
defined('QUESTION_STATUS_DELETED') || define('QUESTION_STATUS_DELETED', 3);

defined('OFFER_STATUS_OPEN') || define('OFFER_STATUS_OPEN', 1);
defined('OFFER_STATUS_ACCEPTED') || define('OFFER_STATUS_ACCEPTED', 2);
defined('OFFER_STATUS_REJECTED') || define('OFFER_STATUS_REJECTED', 3);
