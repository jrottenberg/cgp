<?php

# Collectd Varnish plugin

# Details on https://github.com/octo/collectd/blob/master/src/varnish.c

require_once 'conf/common.inc.php';
require_once 'type/GenericStacked.class.php';
require_once 'inc/collectd.inc.php';

## LAYOUT
#
# varnish-default-backend/connections-failures.rrd
# varnish-default-backend/connections-not-attempted.rrd
# varnish-default-backend/connections-recycled.rrd
# varnish-default-backend/connections-reuses.rrd
# varnish-default-backend/connections-success.rrd
# varnish-default-backend/connections-too-many.rrd
# varnish-default-backend/connections-unused.rrd
# varnish-default-backend/connections-was-closed.rrd
#
# varnish-default-cache/cache_result-hitpass.rrd
# varnish-default-cache/cache_result-hit.rrd
# varnish-default-cache/cache_result-miss.rrd
#
# varnish-default-connections/connections-accepted.rrd
# varnish-default-connections/connections-dropped.rrd
# varnish-default-connections/connections-received.rrd
#
# varnish-default-shm/total_operations-contention.rrd
# varnish-default-shm/total_operations-cycles.rrd
# varnish-default-shm/total_operations-flushes.rrd
# varnish-default-shm/total_operations-records.rrd
# varnish-default-shm/total_operations-writes.rrd
#

$obj = new Type_GenericStacked($CONFIG);
$obj->width = $width;
$obj->heigth = $heigth;

$obj->rrd_title = sprintf('varnish: %s (%s)', $obj->args['pinstance'], $obj->args['type']);
$obj->rrd_format = '%5.1lf%s';

collectd_flush($obj->identifiers);
$obj->rrd_graph();


