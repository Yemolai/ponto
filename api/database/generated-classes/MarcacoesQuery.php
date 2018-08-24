<?php

use Base\MarcacoesQuery as BaseMarcacoesQuery;

/**
 * Skeleton subclass for performing query and update operations on the 'marcacoes' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class MarcacoesQuery extends BaseMarcacoesQuery
{
  /**
   * Filter the query on the datetime column by a given month
   *
   * Example usage:
   * <code>
   * $query->filterByDatetime(4); // WHERE datetime >= '2018-04-01' AND datetime <= '2018-04-30'
   * $query->filterByDatetime(); // WHERE datetime >= '2018-08-01' AND datetime <= '2018-08-31'
   * $query->filterByDatetime(12, 2017); // WHERE datetime >= '2017-12-01' AND datetime <= '2017-12-31'
   * </code>
   *
   * @param     mixed $month The month to use as filter. Current month will be used if NULL.
   *   Values can be integers (1 <= month <= 12) or strings. Empty strings are treated as NULL.
   * @param     string $year The year to use as filter. Current year will be used if NULL.
   *   Values can be integers (1970 <= year <= 2100) or strings. Empty strings are treated as NULL.
   *
   * @return $this|ChildMarcacoesQuery The current query, for fluid interface
   */
  public function filterByMonth($month = null, $year = null, array $options = ['tz' => null]) {
    $tz = new DateTimeZone(array_key_exists('tz', $options) ? $options['tz'] : 'America/Belem');
    // $month validation
    if ($month !== null && (!is_numeric($month) || intval($month) < 0 || intval($month) > 11)) {
      return $this;
    }
    // $year validation
    if ($year !== null && (!is_numeric($year) || intval($year) < 1970 || intval($year) > 2100)) {
      return $this;
    }
    $now = new Datetime('now', $tz);
    $m = $month !== null ? intval($month) : intval($now->format('m'));
    $y = $year !== null ? intval($year) : intval($now->format('YYYY'));
    $strM = str_pad((string)$m, 2, '0', STR_PAD_LEFT);
    $strMin = implode('-', array($y, $strM, '01'));
    $min = Datetime::createFromFormat('Y-m-d', $strMin, $tz);
    $lastDay = $min->format('t');
    $max = Datetime::createFromFormat('Y-m-d', implode('-', array($y, $strM, $lastDay)), $tz);
    return $this->filterByDatetime(['min' => $min, 'max' => $max]);
  }

  private static function sortByDateTime(array $a, array $b) {
    return $a['datetime'] > $b['datetime'] ? 1 : $a['datetime'] < $b['datetime'] ? -1 : 0;
  }

  /**
   *
   */
  public function toDayGroupMatrix($includePIS = false, $tzOffset = 0, $groupDateFormat = 'Y-m-d', $timeFormat = 'H:i:sP') {
    $marcacoes = $this->find();
    $data = [];
    foreach ($marcacoes as $key => $marcacao) {
      $datetime = $marcacao->getDateTime()->modify($tzOffset . ' hours');
      $dia = $datetime->format($groupDateFormat);
      $value = array(
        'nsr'=> $marcacao->getPonto() . '-' . $marcacao->getNsr(),
        'datetime'=> $datetime->format($timeFormat),
      );
      if ($includePIS) {
        $value['pis'] = $marcacao->getPis();
      }
      if (array_key_exists($dia, $data)) {
        array_push($data[$dia], $value);
      } else {
        $data[$dia] = array($value);
      }
      usort($data[$dia], array('MarcacoesQuery', 'sortByDateTime'));
    }
    krsort($data);
    return $data;
  }
}
