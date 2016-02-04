import math

class First5:

	station = [14.012313,121.034523]
	reports = [[1,14.12341,121.21231231],
				[2,14.4564623,121.234234],
				[3,14.236454,121.967342],
				[4,14.572342,121.234234]]
	top5 = []

	def __init__(self):
		for row in self.reports:
			d = self.getDistance(self.station[0], row[1], self.station[1], row[2])
			if len(self.top5) == 3:
				for rowData in self.top5:
					if rowData[1] > d:
						self.top5[self.top5.index([rowData[0],rowData[1]])] = [row[0],d]
			else:
				self.top5.append([row[0],d])
		print self.top5
		# print self.reports.index([2,14.4564623,121.234234])

	def getDistance(self, lat1, lat2, long1, long2):
		R = 6378137
		dLat = abs(lat2 - lat1)
		dLong = abs(long2 - long1)
		a = math.sin(dLat / 2) * math.sin(dLat / 2) + math.cos(lat1) * math.cos(lat2) * math.sin(dLong / 2) * math.sin(dLong / 2)
		c = 2 * math.atan2(math.sqrt(a), math.sqrt(1 - a))
		d = R * c
		return d

if __name__ == "__main__":
	First5()

